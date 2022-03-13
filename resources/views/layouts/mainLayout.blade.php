<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/main.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="{{asset('assets/js/filters.js')}}"></script>
    <script src="{{asset('assets/js/ajax.js')}}"></script>
</head>
<body>
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
    </div>
</nav>
<div class="" id="app">
    <div class="row g-0">
            <nav class="col-2 filter no-gutter">
                <ul class="nav list-group">
                    @include('layouts.filters')
                </ul>
            </nav>
        <main class="col">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
