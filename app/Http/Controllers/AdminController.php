<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $posts = Post::all()->where('created_at','>=',Carbon::today()->startOfMonth()->toDateString())
            ->where('created_at','<=',Carbon::today()->endOfMonth()->toDateString());

//        $posts = Post::all();

        // get all tags from the posts
        $tags_name = [];
        foreach ($posts as $post) {
            foreach($post->tags as $tag){
                $tags_name[] = $tag->name;
            }
        }
        // remove tag duplicates
        $tags_name = array_unique($tags_name);

        // get all posts created this month that includes said tags
        $tags_count = array_map(function ($tag_name) use ($posts) {
            $count = 0;
            foreach($posts as $post) { // loop each post
                foreach($post->tags as $tag) { // loop all tags for each post
                    if ( $tag->name == $tag_name) { // if tag matches
                        $count = $count + 1;
                    }
                }
            }
            return $count;
        }, $tags_name);

        // map the tag to the count, and sort by value, by descending order
        $tags = array_combine($tags_name, $tags_count);
        arsort($tags);

        // only use the first x tags with most posts
        $tag_amount = 5;
        $tags = array_slice($tags, 0, $tag_amount, true);


        // extract the top x tags
        $tags_name = array_keys($tags);
        $tags_count = array_values($tags);

        return view('admin.home',
                ['tags_name' => $tags_name,
                'tags_count' => $tags_count]);
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
