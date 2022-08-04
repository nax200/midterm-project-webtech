@extends('layouts.main')

@section('content')
    <form action="{{ route('posts.update',['post'=>$post]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="relative z-0 mb-6 w-1/3 group">
            <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder="" value="{{$post->title}}" required="" autocomplete="off">
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Title
            </label>
        </div>

        <div class="relative z-0 mb-6 w-1/3 group">
            <input type="text" name="tags" id="tags" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" " value="{{$tags}}" required="" autocomplete="off">
            <label for="tags" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Tags (separated with commas)
            </label>
        </div>

        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
            Description
        </label>
        <textarea name="description" id="description" rows="4" class="block p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Your message..." autocomplete="off">{{$post->description}}
        </textarea>
        <button type="submit" class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="app-button red" type="submit">DELETE</button>
    </form>

@endsection
