<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct() { // php constructor
        $this->middleware(['auth'])->except(['index','show','indexCreateRecent','indexBest','indexPopular','indexUpdated']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',['posts'=>$posts]);
    }

    public function indexCreateRecent()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('posts.index_create_recent',['posts'=>$posts]);
    }

    public function indexBest()
    {
        $posts = Post::all()->sortByDesc('like_count');
        return view('posts.index_best',['posts'=>$posts]);
    }

    public function indexPopular()
    {
        $posts = Post::all()->sortByDesc('view_count');
        return view('posts.index_popular',['posts'=>$posts]);
    }

    public function indexUpdated()
    {
        $posts = Post::all()->sortByDesc('resolved_date');
        return view('posts.index_updated',['posts'=>$posts]);
    }

    public function indexUnresolved()
    {
        $this->authorize('resolve', Post::class);
        $posts = Post::all()->sortByDesc('created_at');
        return view('posts.index_unresolved',['posts'=>$posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5', 'max:1000'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:100000000']
        ]); // เกิด errors

        $post = new Post();

        if (($request->image != null)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $post->pictures = $imageName;
        }

        if ($request->issue_date != null and
            $request->issue_date != 0) {
            $validated = $request->validate(['issue_date' => ['date_format:Y-m-d']]);
            $date = strtotime($request->input('issue_date'));
            $date = date('Y-m-d H:i:s',$date);
            $post->issue_date = $date;
        }
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if((string)$request->incognito == "1"){
        $post->incognito = $request->incognito;
        }else{
            $post->incognito = "0";
        }
        $post->user_id = Auth::user()->id;
//        dd($post);
        $post->save();

        $tags = $request->get('tags');
        $tag_ids = $this->syncTags($tags);
        $post->tags()->sync($tag_ids);

        return redirect()->route('posts.show', [ 'post' => $post->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (is_int($post->view_count)) {
            $post->view_count = $post->view_count + 1;
            $post->save();
        }
        return view('posts.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $tags = $post->tags->pluck('name')->all();
        $tags = implode(", ", $tags);
        return view('posts.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5', 'max:1000']
        ]);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if ($request->issue_date != null and
            $request->issue_date != 0) {
        $validated = $request->validate(['issue_date' => ['date_format:Y-m-d']]);
        $date = strtotime($request->input('issue_date'));
        $date = date('Y-m-d H:i:s',$date);
        $post->issue_date = $date;
        }else{
        $post->issue_date = null;
        }
        if((string)$request->incognito == "1"){
            $post->incognito = $request->incognito;
        }else{
            $post->incognito = "0";
        }
        $post->save();

        $tags = $request->get('tags');
        $tag_ids = $this->syncTags($tags);
        $post->tags()->sync($tag_ids);



        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function storeComment(Request $request, Post $post) {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->message = $request->get('message');
        $post->comments()->save($comment);

//        if (is_int($post->view_count) and $post->view_count > 0) { // subtract the view when refreshing page via commenting
//            $post->view_count = $post->view_count - 1;
//            $post->save();
//        }

        return redirect()->route('posts.show',['post' => $post->id]);
    }

    private function syncTags($tags) {
        // explode() -> แยกสตริงเป็นก้อนๆ
        $tags = explode(',', $tags);
        // แปลง string เพราะมี ' ' ขั้นหน้า เลยต้องตัดออก
        $tags = array_map(function ($v) {
            // associative function (unnamed function / closure)

            // uppercase first
            return Str::ucfirst(trim($v));
        }, $tags);

        $tag_ids = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::where('name', $tag_name)->first();
            if (!$tag) {
                $tag = new Tag();
                $tag->name = $tag_name;
                $tag->save();
            }
            $tag_ids[] = $tag->id;
        }

        return $tag_ids;
    }

    public function updateStatus(Request $request, Post $post)
    {
        $this->authorize('updateStatus', $post);

//        dd($request);
//        dd($post);
        $validated = $request->validate([
            'resolved_date' => ['date_format:Y-m-d'],
            'status' => ['required']]);
        $post->status = $request->input('status');
        $post->resolved_by = $request->input('resolved_by');
        if ($request->resolved_date != null) {
            $date = strtotime($request->input('resolved_date'));
            $post->resolved_date = date('Y-m-d H:i:s', $date);
        }

        $post->agency = $request->input('agency');

        $post->save();



        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function likePost(Request $request, Post $post) {
        $this->authorize('like', $post);
//        $user = Auth::user();
//        foreach ($user->likedPosts as $cur_post) {
//            if ($post->id == $cur_post->id) { // already liked this post
//                if (is_int($post->view_count) and $post->view_count > 0) { // subtract the view when refreshing page via liking
//                    $post->view_count = $post->view_count - 1;
//                    $post->save();
//                }
//                return redirect()->route('posts.show',['post' => $post->id]);
//            }
//        }
        if (is_int($post->like_count)) {
            $post->like_count = $post->like_count + 1;
            $post->save();
        }
//        if (is_int($post->view_count) and $post->view_count > 0) { // subtract the view when refreshing page via liking
//            $post->view_count = $post->view_count - 1;
//            $post->save();
//        }
//        $user->likedPosts()->save($post);
        return redirect()->route('posts.show',['post' => $post->id]);
    }
}
