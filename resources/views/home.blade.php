<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoRent Service</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/main.css')}}">

    <!-- Font Awesome 6.1.0 Iconic Font -->
    <link rel="stylesheet" href="{{url('css/fontawesome/css/fontawesome.css')}}"/>

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <!-- JQUERY 3.6.0 LIBRARY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DATETIME-PICKER -->
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{url('assets/bootstrap5/css/bootstrap-datetimepicker.css')}}"/>
    <!-- JavaScript -->
    <script src="{{asset('assets/bootstrap5/js/bootstrap-datetimepicker.js')}}"></script>
    <!-- Languages -->
    <script src="{{asset('assets/bootstrap5/js/locales/bootstrap-datetimepicker.ua.js')}}"></script>

    <!-- Fancypps -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>

    <!-- FILTERS, AJAX, STYLE JS -->
    <script src="{{asset('assets/js/app.js')}}"></script>
</head>
<body class="homeMain">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">AutoRent Service</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('transport.index')}}">Transport</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('country.index')}}">Countries</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('carBodyType.index')}}">Car body types</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('owner.index')}}">Owners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tenant.index')}}">Tenants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('rent.index')}}">Rents</a>
                </li>
            </ul>
        </div>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
<div class="" id="app">
    <div class="textBlock"><h1 class="text">Не водите машину быстрее, чем летает Ваш <span
                class="word">ангел-хранитель</span></h1></div>
    <div class="slider" id="main-slider">
        <div class="slider-wrapper">
            <div class="slide" data-image="css/images/t1.jpg"></div>
            <div class="slide" data-image="css/images/t2.jpg"></div>
            <div class="slide" data-image="css/images/t3.jpg"></div>
            <div class="slide" data-image="css/images/t4.jpg"></div>
            <div class="slide" data-image="css/images/t5.png"></div>
        </div>
        <div class="slider-nav">
            <button class="slider-previous">Previous</button>
            <button class="slider-next">Next</button>
        </div>
    </div>
</div>
</body>
</html>
