@extends('layouts.main')

@section('content')
    <form action="{{ route('posts.update',['post'=>$post]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="relative z-0 my-6 w-1/3 ml-4 group">
            <input type="text" name="title" id="title"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer"
                   @can('updateStatus', $post) disabled @endcan
                   placeholder="" value="{{$post->title}}" required="" autocomplete="off">
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Title
            </label>
        </div>

        <div class="relative z-0 my-4 w-1/3 ml-4 group">
            <input type="text" name="tags" id="tags"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer"
                   @can('updateStatus', $post) disabled @endcan
                   placeholder=" " value="{{$tags}}" required="" autocomplete="off">
            <label for="tags" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Tags (separated with commas)
            </label>
        </div>

        <label for="description" class="block my-2 ml-4 text-sm font-medium text-gray-900 dark:text-gray-400">
            Description
        </label>
        <textarea name="description" id="description" rows="4"
                  class="block ml-4 p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                  @can('updateStatus', $post) disabled @endcan
                  placeholder="Your message..." autocomplete="off">{{$post->description}}
        </textarea>

        @cannot('updateStatus', $post)
            <button type="submit" class="app-button my-2 ml-4 ">Submit</button>
        @endcannot


    </form>


    @can('updateStatus', $post)
    <form action="{{ route('posts.update.status',['post'=>$post]) }}" method="post">
        @csrf
            <div>
                <label for="status" class="block my-2 ml-4 text-sm max-w-sm font-medium text-gray-900 dark:text-gray-400">Select an option</label>
                <select id="status" name="status" class="ml-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-auto max-w-sm p-2.5 ">
                    <option value="wait">Waiting Reply</option>
                    <option value="done">Resolved</option>
                    <option value="int">Intended</option>
                    <option value="info">Need More Information</option>
                    <option value="fix">Waiting Fix</option>
                </select>
            </div>

        <div class="relative z-0 my-2 w-1/3 group ml-4">
            <input type="text" name="resolved_by" id="resolved_by"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer"
                   placeholder=" " value="{{$post->resolved_by}}" required="" autocomplete="off">
            <label for="resolved_by" class="mt-2 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Resolved By
            </label>
        </div>



        <div class="relative ml-4 max-w-sm w-auto">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="resolved_date" datepicker="" datepicker-buttons="" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 datepicker-input" placeholder="Select date">
        </div>


        <button type="submit" class="app-button my-2 ml-4 font-medium text-sm w-full sm:w-auto px-5 py-2.5">Edit Status</button>

    </form>
    @endcan

    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="app-button red ml-4 " type="submit">DELETE</button>
    </form>

@endsection
