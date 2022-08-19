<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (!Auth::user()->isAdmin()) {
//            abort(403);
//        }
        $this->authorize('forceDelete', Post::find(1));
        // get all posts created this month
        $posts = Post::all()->where('created_at','>=',Carbon::today()->subMonth()->toDateString());
        $posts_id = $posts->pluck('id')->toArray();

        // get tags from posts created this month
        $tags = Tag::all();
        $tags = $tags->sortByDesc(function ($tag) use ($posts_id) {
//            $count = 0;
//            $tag_posts = $tag->posts;
//            foreach($tag_posts as $post) {
//                if (in_array($post->id, $posts_id)) {
//                    $count = $count + 1;
//                }
//            }
//            return $count;
            // fixable by creating a new variable in database
            return $tag->posts->count();

        });

        $tags = $tags->toArray();

//        only use the first x tags
        $tag_amount = 5;
        $tags_charted = array_slice($tags, 0, $tag_amount, true);
//        $tags_charted = $tags;
        $tags_charted = Tag::hydrate($tags_charted);
        // pluck id and name for chart
        $tags_id = $tags_charted->pluck('id');
        $tags_name = $tags_charted->pluck('name');

        // sort the chosen tags again
        $tags = Tag::all()->whereIn('id',$tags_id)->sortByDesc(function ($tag) use ($posts_id) {
//            $count = 0;
//            $tag_posts = $tag->posts;
//            foreach($tag_posts as $post) {
//                if (in_array($post->id, $posts_id)) {
//                    $count = $count + 1;
//                }
//            }
//            return $count;
            return $tag->posts->count();
        });

        $tags_posts = [];

        foreach ($tags as $tag) {
            $tags_posts[] = $tag->posts->count();
        }
        $tags_posts = collect($tags_posts);



//        dd($tags_posts);
        return view('admin.home',
                ['tags'=>$tags,
                'tags_name' => $tags_name,
                'tags_posts' => $tags_posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
