@extends('layouts.main')

@section('content')
    <form action="{{ route('posts.update',['post'=>$post]) }}" method="post">
        @csrf
        @method('PUT')
        @if ($errors->has('title'))
                <p class="text-red-600 ml-4">
                    {{ $errors->first('title') }}
                </p>
            @endif
        <div class="relative z-0 my-6 w-1/3 ml-4 group">
            <input type="text" name="title" id="title"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer"
                   @can('updateStatus', $post) disabled @endcan
                   placeholder="" value="{{$post->title}}" autocomplete="off">
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Title
            </label>
        </div>

        <div class="relative z-0 my-4 w-1/3 ml-4 group">
            <input type="text" name="tags" id="tags"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer"
                   @can('updateStatus', $post) disabled @endcan
                   placeholder=" " value="{{$tags}}" autocomplete="off">
            <label for="tags" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Tags (separated with commas)
            </label>
        </div>
        @if ($errors->has('title'))
                <p class="text-red-600 ml-4">
                    {{ $errors->first('title') }}
                </p>
            @endif
        <label for="description" class="block my-2 ml-4 text-sm font-medium text-gray-900 dark:text-gray-400">
            Description
        </label>
        <textarea name="description" id="description" rows="4"
                  class="block ml-4 p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                  @can('updateStatus', $post) disabled @endcan
                  placeholder="Your message..." autocomplete="off">{{$post->description}}
        </textarea>
        @if ($errors->has('issue_date'))
            <p class="text-red-600 ml-4">
                {{ $errors->first('issue_date') }}
            </p>
        @endif
            </div>
            <input name="issue_date" id="issue_date" size="26" value="{{$post->issue_date}}" class="my-2 ml-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5  datepicker-input" placeholder="Issue date format:YYYY-mm-dd"
            @can('updateStatus', $post) disabled @endcan>
        </div>

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

        @if ($errors->has('resolved_date'))
            <p class="text-red-600 ml-4">
                {{ $errors->first('resolved_date') }}
            </p>
        @endif
        <div>
            <input name="resolved_date" id="resolved_date" size="29" value="{{$post->resolved_date}}" class="ml-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5  datepicker-input" placeholder="Resolved date format:YYYY-mm-dd">
        </div>
        <button type="submit" class="ml-4 mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Status</button>

    </form>
    @endcan

    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="app-button red ml-4 my-2" type="submit">DELETE</button>
    </form>

@endsection
