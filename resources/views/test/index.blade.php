@extends('layouts.main')

@section('content')
    @auth
        @foreach($users as $user)
            <p>
                {{ $user->name }}
                <img src="{{ url($user->profile_image) }}" alt="" title="" width="200"/>
            </p>
        @endforeach
    @endauth
@endsection
