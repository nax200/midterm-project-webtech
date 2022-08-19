@extends('layouts.main')

@section('content')
    <div class="mb-4 ml-4">
        <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
            <svg class="w-6 h-6 inline mr-1" viewBox="0 0 20 20">
                <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
            </svg>
            {{ $post->view_count }} views
        </p>

        <p class="bg-green-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-6 inline mr-1" viewBox="0 0 16 16">
                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
            </svg>
            {{ $post->like_count }} likes
        </p>
    </div>
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ml-4">
        {{$post->title}}
    </h5>
    <h3 class="mb-2 text-xl tracking-tight text-gray-900 ml-4">
        {{$post->user->name}}
    </h3>

    <div class="my-4 ml-4">
        @foreach($post->tags as $tag)
            <p class="bg-green-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                {{ $tag->name }}
            </p>
        @endforeach
    </div>
    <p class="font-normal text-gray-700 dark:text-gray-400 ml-4">
        {{$post->description}}
    </p>

    <div>
        @if ($post->pictures != null)
            <image src="{{ url( 'storage/images/'.$post->pictures) }}" alt="" title="" width="200">
        @endif
    </div>

    <div>
        <p class="ml-4 my-2">
            Issue Date:
            @if($post->issue_date != null)
                {{$post->issue_date}}
            @else
                -
            @endif
        </p>
    </div>

    <div>
        <p class="ml-4 my-2">
            Status:
            @if ($post->status == 'wait')
            Waiting Reply
            @elseif ($post->status == 'done')
            Resolved
            @elseif($post->status == 'int')
            Intended
            @elseif($post->status == 'info')
            Need More Information
            @elseif($post->status == 'fix')
            Waiting Fix
            @endif
        </p>
    </div>
    <div>
        <p class="ml-4 my-2">
            Resolved By:
            @if($post->resolved_by != null)
                {{$post->resolved_by}}
            @else
                -
            @endif
        </p>
    </div>

    <div>
        <p class="ml-4 my-2">
            Resolved At:
            @if($post->resolved_date != null)
                {{$post->resolved_date}}
            @else
                -
            @endif
        </p>
    </div>

    @can('update', $post)
    <div class="mt-4">
        <a class="app-button my-5 ml-4" href="{{ route('posts.edit', ['post' => $post]) }}">
            Edit this post
        </a>
    </div>
    @endcan

    <section class="mx-16 mt-8">
        <form action="{{route('posts.comments.store',['post'=>$post->id])}}" method="post">
            @csrf

            <div>
                <label for="message" class="sr-only">Your message</label>
                <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <button type="button" class=" hidden inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Upload image</span>
                    </button>
                    <button type="button" class=" hidden p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Add emoji</span>
                    </button>
                    <textarea name="message" id="message" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Your message..."></textarea>
                    <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 ">
                        <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span class="sr-only">Send message</span>
                    </button>
                </div>
            </div>
        </form>
    </section>

    <section class="mt-8">
        <h2 class="text-2xl mb-2 ml-4">Comments</h2>
        @if($post->comments->isNotEmpty())
            @foreach($post->comments->sortByDesc('created_at') as $comment)
            <div class="flex flex-wrap space-y-2 mx-16 my-4">
                    <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                        <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                            {{ $comment->created_at->diffForHumans() }} by {{$comment->user->name}}
                        </p>
                        <div class="text-xl pl-4">
                            {{ $comment->message }}
                        </div>
                    </div>
                @can('delete', $comment)
                <button class="block app-button red" onclick="showDelete()" class="app-button red">DELETE</button>
                @endcan
            </div>
            <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" method="post">
            @csrf
            @method('DELETE')
            <div hidden id="popup">
            <div id="popup-modal" tabindex="-1" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center flex" aria-modal="true" role="dialog">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                    <!-- <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> -->
                    </button>
                    <div class="p-6 text-center">
                    <!-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> -->
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this comment?</h3>
                    <button method="post" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" onclick="hideDelete()">No, cancel</button>
                </div>
                </div>
                </div>
                </div>
                </div>
                </form>
                <script>
                    function showDelete() {
                        document.getElementById("popup").hidden = false;
                    }
                    function hideDelete() {
                        document.getElementById("popup").hidden = true;
                    }
                </script>
            @endforeach
        @else
            <div class="pl-8">
                Be the first one to comment...
            </div>
        @endif
    </section>
@endsection
