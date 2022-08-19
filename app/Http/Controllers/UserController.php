<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Rules\CheckOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function index()
    {
        //
    }
    
    public function userPosts()
    {
        $posts = Post::all()->where('user_id',Auth::user()->id);
        // $posts = Post::all();
        return view('posts.user',['posts'=>$posts]);
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

    
    public function show(User $user)
    {
        return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        if(strlen($request->input('oldpassword'))>0||strlen($request->input('password'))>0 || strlen($request->input('password_confirmation'))>0){
        $validated = $request->validate([
            'password' => ['min:8','confirmed', Rules\Password::defaults()]
            ]);
        $validated = $request->validate([
            'oldpassword' => ['required',new CheckOldPassword()]
            ]);
        $user->password = Hash::make($request->input('password'));
        }
        if($request->image != null){
        $validated = $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:1000000']]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/profiles', $imageName);
        $user->profile_image = $imageName;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->description = $request->input('description');
        $user->save();
        return redirect()->route('users.show',['user'=>$user->id]);
    }
    

    
}
