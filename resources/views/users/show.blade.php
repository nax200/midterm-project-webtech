@extends('layouts.main')

@section('content')
{{--    @can('create', Post::class)--}}
    <section class="mx-8">
        <div class="overflow-hidden relative w-40 h-40 bg-gray-800 rounded-full">
        <img src="{{ url('storage/profiles/'.$user->profile_image) }}" alt="" title=""/>
        </div>
        <br><h1 class="text-3xl mt-6">
            {{ $user->name }}

            </h1>
        <br><a href="{{route('users.posts', ['user'=>$user->id])}}" class="inline-block">
            <button type="button" class="app-button-seemore">
                <div class="inline-flex items-center">
                    See my posts
                </div>
            </button>
        </a>
        <br>
        <br class="mx-8 mt-2">
            Email: {{$user->email}}
        <br>
        <br class="mx-8 mt-2">
            Description: {{$user->description}}
        <br>
        @auth
        @if (Auth::user()->id == $user->id)
        <a class="mt-4 flex w-14 rounded-lg bg-gray-800 hover:bg-gray-600 focus:ring-gray-700 text-white border-gray-600" href="{{route('users.edit', ['user'=>$user->id])}}"><div class="ml-3 my-2">edit</div></a>
            @endif
            @endauth
    </section>



@endsection
