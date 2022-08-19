@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <div class="overflow-hidden relative w-20 h-20 bg-gray-800 rounded-full">
        <img src="{{ url('storage/profiles/'.Auth::user()->profile_image) }}" alt="" title=""/>
        </div>
        <br><h1 class="text-3xl mx-2 my-6">
            Name: {{ $user->name }}
            </h1>
        <br class="mx-8 mt-2">
            Email: {{$user->email}}
        </br>
        <br class="mx-8 mt-2">
            Description: {{$user->description}}
        </br>
        <a class="mt-4 flex w-14 rounded-lg bg-gray-800 hover:bg-gray-600 focus:ring-gray-700 text-white border-gray-600" href="{{route('users.edit', ['user'=>Auth::user()->id])}}"><div class="ml-3 my-2">edit</div></a>
    </section>



@endsection