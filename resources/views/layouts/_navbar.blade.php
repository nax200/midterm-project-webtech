<nav class="bg-white border-gray-200 px-1 sm:px-1 py-2.5 rounded">
    <div class="container flex flex-wrap justify-between items-center mr-auto">
        <a href="{{ url('/') }}" class="flex items-center">
            <span class="text-xl font-semibold whitespace-nowrap ml-4" >Ham Sandwich</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white ">
                @auth
                    <li class="mt-3">
                        {{ Auth::user()->name }}    {{ Auth::user()->email }}
                        
                    </li>
                <li>
                    <a href="{{route('posts.index')}}"
                       class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline mt-3 @if(Route::currentRouteName() === 'posts.index') current-page @endif" >
                        Posts
                    </a>
                </li>
                <li>
                    <a href="{{route('tags.index')}}"
                       class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline mt-3 @if(Route::currentRouteName() === 'tags.index') current-page @endif" >
                        Tags
                    </a>
                </li>
                <li>
                    <a href="{{route('posts.create')}}"
                       class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline mt-3 @if(Route::currentRouteName() === 'posts.create') current-page @endif" >
                        Create Post
                    </a>
                </li>
                <li>
                    <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600">
                        <img src="{{ url('storage/profiles/'.Auth::user()->profile_image) }}" alt="" title=""/>
                    </div>
                </li>
                <div class="flex">
         <button id="states-button" data-dropdown-toggle="dropdown-states" class=" flex-shrink-0 z-10 inline-flex rounded-lg items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
        <svg aria-hidden="true" class="h-3" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="mask0_12694_49953" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="15" height="12"><rect x="0.5" width="14" height="12" rx="2" fill="white"/></mask></svg>
        Menu <svg aria-hidden="true" class=" w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
    <div id="dropdown-states" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="states-button">
            <li>
            <a href="{{route('users.show',['user'=> Auth::user()])}}">
                <button type="button" class="inline-flex rounded py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 text-gray-400 hover:bg-gray-600 hover:text-white">
                    <div class="inline-flex items-center">
                        Profile
                    </div>
                </button>
            </a>
            <a href="{{route('users.edit', ['user'=>Auth::user()->id])}}">
                <button type="button" class="inline-flex rounded py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 text-gray-400 hover:bg-gray-600 hover:text-white">
                    <div class="inline-flex items-center">
                        Edit Profile
                    </div>
                </button>
            </a>
            <a href="{{route('users.posts', ['user'=>Auth::user()->id])}}">
                <button type="button" class="inline-flex rounded py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 text-gray-400 hover:bg-gray-600 hover:text-white">
                    <div class="inline-flex items-center">        
                        Own Post
                    </div>
                </button>
            </a>
            </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                class="text-gray-400">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{route('login')}}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'login') current-page @endif" >
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="{{route('register')}}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'register') current-page @endif" >
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

