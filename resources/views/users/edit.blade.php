@extends('layouts.main')

@section('content')
    <h1 class="px-4 text-3xl bg-gray-700 rounded-2xl">
        Edit Profile
    </h1>

    <form action="{{route('users.update', ['user'=> Auth::user()])}}" method="post" enctype="multipart/form-data">
        @csrf {{-- prevent sea cerf attack --}}
        @method('PUT')
        <div class="ml-4 mt-2 overflow-hidden relative w-20 h-20 bg-gray-100 rounded-full dark:bg-gray-600">
            <img src="{{ url('storage/profiles/'.Auth::user()->profile_image) }}" alt="" title=""/>
        </div>
        <div class="ml-4 mt-2">
            <label for="name">Name: </label><br>
            <input class="app-bg-input" type="text" name="name" value="{{old('name',$user->name)}}">
        </div>

        <div class="mt-4 ml-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full max-w-sm" type="email" name="email" value="{{old('email',$user->email)}}" required />
            </div>
        <div class="ml-4 mt-2">
            <label class="block" for="description">Description: </label>
            <textarea class="app-bg-input" name="description" id="" cols="30" rows="1">{{old('description',$user->description)}}</textarea>
        </div>
        <div class="mt-4 ml-4">
                <x-label for="oldpassword" :value="__('Old Password')" />
                @error('oldpassword')
                <p class="text-red-600">
                    {{$errors->first('oldpassword')}}
                </p>
                @enderror
                <x-input id="oldpassword" class="block mt-1 w-full max-w-sm"
                                type="password"
                                name="oldpassword"
                />
            </div>
        <div class="mt-4 ml-4">
                <x-label for="password" :value="__('New Password')" />
                @error('password')
                <p class="text-red-600">
                    {{$errors->first('password')}}
                </p>
                @enderror
                <x-input id="password" class="block mt-1 w-full max-w-sm"
                                type="password"
                                name="password"
                />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 ml-4 my-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full max-w-sm"
                                type="password"
                                name="password_confirmation" />
            </div>
            <div class="row">
            <div class="col-md-6 ml-4">
                <input type="file" name="image" id="image" class="form-control">
            </div>
            </div>

        @if ($errors->has('image'))
            <p class="text-red-600 ml-4">
                {{ $errors->first('image') }}
            </p>
        @endif

{{--        @if (count($errors) > 0)--}}
{{--            <div class="alert alert-danger ml-4">--}}
{{--                <strong>Whoops!</strong> There were some problems with your input.--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
        <div>
            <button class="app-button ml-4 mt-4" type="submit">Edit</button>
        </div>
    </form>
@endsection
