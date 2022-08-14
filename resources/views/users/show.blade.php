@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600">
        <img src="{{ url('storage/profiles/'.Auth::user()->profile_image) }}" alt="" title=""/>
        </div>
        <h1 class="text-3xl mx-4 mt-6">
            Name: {{ $user->name }}
        </h1>
        <br class="mx-8 mt-2">
            Email: {{$user->email}}
        </br>
        <br class="mx-8 mt-2">
            Description: {{$user->description}}
        </br>
        <u><a class="app-button-edit" href="{{route('users.edit', ['user'=>$user->id])}}">edit</a></u>
    </section>



@endsection