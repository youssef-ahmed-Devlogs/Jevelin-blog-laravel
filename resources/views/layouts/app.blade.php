<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;0,800;1,300;1,500&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/index_ar.css') }}">
    @endif
</head>

<body class="@if (Request::is('/')) home @endif @if (Route::currentRouteName() == 'articles.show') has-breadcrumb @endif">

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if (Request::is('/'))
                        <img src="{{ asset('assets/images/logo_white.png') }}"
                            alt="{{ config('app.name', 'Laravel') }}">
                    @else
                        <img src="{{ asset('assets/images/logo_dark.png') }}"
                            alt="{{ config('app.name', 'Laravel') }}">
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('public.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('public.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <form action="" method="GET">
                                    <input type="text" name="s" class="form-control" placeholder="Search..."
                                        value="{{ isset($searchQuery) ? $searchQuery : '' }}">
                                    @if (isset($categoryQuery) && $categoryQuery != 'all')
                                        <input type="hidden" name="category" value="{{ $categoryQuery }}"
                                            class="form-control" placeholder="Search...">
                                    @endif
                                </form>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        {{ __('public.profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('articles.create') }}">
                                        {{ __('public.addArticle') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('public.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item dropdown language-menu">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('assets/images/' . App::getLocale() . '.png') }}" alt="">
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @foreach (config('translatable.locales') as $locale)
                                    @if (App::getLocale() != $locale)
                                        <a class="dropdown-item" href="{{ route('locale.set', $locale) }}">
                                            <img src="{{ asset('assets/images/' . $locale . '.png') }}" alt="">
                                            {{ strtoupper($locale) }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        @if (Route::currentRouteName() == 'articles.show')
            <ul class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('public.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ substr($article->title, 0, 100) }}
                </li>
            </ul>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
