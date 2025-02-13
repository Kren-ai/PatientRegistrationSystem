<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Patient Management System') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navbar')

    <div class="flex">
        @include('layouts.sidebar')

        <div class="container">
            @isset($header)
                <div class="card">
                    <h2>{{ $header }}</h2>
                </div>
            @endisset

            <div class="card">
                @yield('content')
            </div>
        </div>
    </div>

        <div class="footer">
            @include('layouts.footer')
        </div>
</body>
</html>
