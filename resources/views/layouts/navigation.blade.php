<nav x-data="{ open: false }" class="bg-white border-b border-gray-4000">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex justify-between">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('item.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

            <div id="searchBox" class="hidden absolute  bg-white p-7">
            <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" placeholder="検索...">

                    <div class="list1">
                        <div class="list1-title">woman</div>
                        <select name="woman_category">
                            <option value="" checked>選択してください</option>
                            @foreach ($parent_categories as $parent_category)
                                @if ($parent_category->gender == 0 || $parent_category->gender == 2)
                                    <option value="{{ $parent_category->name }}" disabled>{{ $parent_category->name }}</option>
                                    @foreach ($child_categories as $child_category)
                                        @if ($parent_category->id == $child_category->category_id && $child_category->gender == 2)
                                            <option value="{{$child_category->name}}">{{$child_category->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="list1">
                        <div style="">man</div>
                        <select name="man_category">
                            <option value="" checked>選択してください</option>
                            @foreach ($parent_categories as $parent_category)
                                @if ($parent_category->gender == 0 || $parent_category->gender == 1)
                                    <option value="{{ $parent_category->name }}" disabled>{{ $parent_category->name }}</option>
                                    @foreach ($child_categories as $child_category)
                                        @if ($parent_category->id == $child_category->category_id && $child_category->gender == 1)
                                            <option value="{{$child_category->name}}">{{$child_category->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        <button type="submit">検索</button>
                    </div>
                </form>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 ">
                <div class="mx-10">
                    <button id="searchIcon" class="w-11 mx-7 mt-2">
                        <img src="{{ asset('/css/img/search-icon.png')}}">
                    </button>

                    <a href="/carts/index">
                        <button id="icon" class="w-10 mx-7 -mt-2">
                            <img src="{{ asset('/css/img/cart-icon.png')}}">
                        </button>
                    </a>

                    <a href="/history">
                        <button id="icon" class="w-10 mx-7 -mt-2">
                            <img src="{{ asset('/css/img/purchase-history.png')}}">
                        </button>
                    </a>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @auth
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endauth
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @guest
                    <a href="{{route('register')}}">
                        <div class="w-11 h-11">
                            <img src="{{ asset('/css/img/login-icon.png')}}">
                        </div>
                    </a>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
