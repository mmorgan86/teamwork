<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-page theme-light">
    <div id="app">
        <!-- left side of navbar -->
        <nav class="bg-header section content-center">
            <div class="container mx-auto items-center py-4">
                <div class="flex justify-between align-items">
                    <h1>
                        <a class="navbar-brand align-items" href="{{ url('/projects') }}">
                        <img src="/images/teamWork.png" alt="TeamWork" style="height: 70px;">
                            <!-- {{ config('app.name', 'TeamWork') }} -->
                        </a>
                    </h1>
                    <!-- /Left Side Of Navbar -->

                    <div class="flex">
                        <!-- Right Side Of Navbar -->
                        <div class="flex items-center text-muted ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <a class="nav-link mr-2 text-accent no-underline" href="{{ route('login') }}">
                                {{-- <img src="/images/teamwork.png" alt="Teamwork"> --}}
                                    {{ __('Login') }}
                                </a>
                                @if (Route::has('register'))
                                    <a class="nav-link text-accent no-underline" href="{{ route('register') }}">{{ __
                                    ('Register')
                                    }}</a>
                                @endif
                            @else

                                <theme-switcher></theme-switcher>

                                <dropdown align="right" width="200px">
                                    <template v-slot:trigger>
                                        <button
                                            class="flex items-center text-default no-underline text-sm border-none"
                                            style="background:transparent;"
                                        >
                                            <img
                                                src="{{ gravatar_url(Auth::user()->email) }}"
                                                class="rounded-full h-16 mr-8"
                                                alt="avatar"
                                            >

                                            {{ Auth::user()->name }}

                                        </button>
                                    </template>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-menu-link w-full
                                        text-left border-none" style="background:transparent;">Logout</button>
                                    </form>

                                </dropdown>
{{--                                <a href="#" class="dropdown-menu-link" onclick="javascript: document.querySelector--}}
{{--                                ('#logout-form').submit()"></a>--}}


                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="section">
            <main class="container mx-auto py-4 sm:w-full">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
