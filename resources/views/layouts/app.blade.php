<!doctype html>

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

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .iti #register_phone_code{
            padding-left: 0!important;
            visibility: hidden;
            opacity: 0;
        }
        .iti .iti__flag-container {
            width: 100%;
        }
        .iti.iti--allow-dropdown {
            width: 100%;
        }
        .iti .iti__selected-flag {
            padding: 0 0.75rem 0 0.5rem;
            border-radius: 30px;
            width: 100%;
            border: 1px solid #dae1e7;
            justify-content: start;
        }
        .iti .iti__selected-flag {
            border: 2px solid #ebf0f7;
        }
        .iti .iti__country-list .iti__flag {
            border-radius: 30px;
        }
        .iti .iti__selected-dial-code {
            color: #5e6d77;
        }
        .iti .iti__arrow {
            margin-left: auto;
        }
        .iti.iti--separate-dial-code .iti__selected-flag {
            background-color: rgb(255 255 255);
        }
        .iti.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
            background-color: rgb(255 255 255);
        }
        .iti .iti__selected-flag .iti__flag {
            border-radius: 10px;
        }
        .iti.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
            padding-left: 3.6rem;
        }
       .iti .iti__flag-container ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 5px  #adaaaa;
            border-radius: 8px;
            background-color: #F5F5F5;
        }
        .iti .iti__flag-container ::-webkit-scrollbar {
            width: 10px;
        }
        .iti .iti__flag-container ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #afb0b3;
        }
        .iti .iti__country-list {
            box-shadow: -2px 2px 10px rgb(0 0 0 / 24%), 1px 7px 10px rgb(0 0 0 / 24%);
            border: 0;
            margin-top: 10px;
            border-top-left-radius: 30px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 30px;
            padding-top: 0;
            padding-bottom: 10px;
            min-height: 250px;
            min-width: 380px;
        }
        .iti .iti__selected-flag {
            border-radius: 33px;
        }
        .iti .iti__country-list .form-control,
        .iti .iti__country-list .form-control,
        .iti .iti__country-list .form-group .form-control{
            padding: 10px 16px 10px 43px;
            height: 45px;
            width: 100%;
            border: 0;
            border-radius: 0;
        }
        .iti .iti__country-list .form-group,
        .iti .iti__country-list .form-group,
        .iti .iti__country-list .form-group {
            margin: 0;
        }
        .iti .iti__country-list .form-group .input-icon {
            position: absolute;
            top: 22px;
            left: 15px;
            font-size: 20px;
            transform: translateY(-50%);
            color: #acb5be;
            line-height: 0
        }
    </style>

</head>

<body>

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">

                    {{ config('app.name', 'Laravel') }}

                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

                    <span class="navbar-toggler-icon"></span>

                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto">



                    </ul>



                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->

                        @guest

                            @if (Route::has('login'))

                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                                </li>

                            @endif



                            @if (Route::has('register'))

                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                                </li>

                            @endif

                        @else

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    {{ Auth::user()->name }}

                                </a>



                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"

                                       onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                        {{ __('Logout') }}

                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                                        @csrf

                                    </form>

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>



        <main class="py-4">

            @yield('content')

        </main>

    </div>

</body>

</html>

