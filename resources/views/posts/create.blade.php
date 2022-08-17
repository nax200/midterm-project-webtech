@extends('layouts.main')

@section('content')
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="relative z-0 mb-6 w-1/3 group">
            @if ($errors->has('title'))
                <p class="text-red-600">
                    {{ $errors->first('title') }}
                </p>
            @endif
            <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 @error('title') border-red-600 @else border-gray-300 @enderror appearance-none focus:outline-none focus:ring-0 focus:border-gray-800 peer"
                   placeholder=" " required="" autocomplete="off">
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Title
            </label>
        </div>

        <div class="relative z-0 mb-6 w-1/3 group">
            <input type="text" name="tags" id="tags" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-800 peer"
                   placeholder=" " required="" autocomplete="off">
            <label for="tags" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Tags (separated with commas)
            </label>
        </div>

        <label for="description" class="block mb-2 text-sm font-medium ">
            Description
        </label>
        @if ($errors->has('description'))
            <p class="text-red-600">
                {{ $errors->first('description') }}
            </p>
        @endif
        <textarea name="description" id="description" rows="4" class="block p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border @error('description') border-red-600 @else border-gray-300 @enderror focus:ring-gray-800 focus:border-gray-800 "
                  placeholder="Your message..." autocomplete="off"></textarea>

        <div class="row">
            <div class="col-md-6">
                <input type="file" name="image" id="image" class="form-control">
            </div>
        </div>

        @if ($errors->has('image'))
            <p class="text-red-600">
                {{ $errors->first('image') }}
            </p>
        @endif

{{--        @if (count($errors) > 0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                <strong>Whoops!</strong> There were some problems with your input.--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

        <button type="submit" class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Create</button>
    </form>

@endsection
