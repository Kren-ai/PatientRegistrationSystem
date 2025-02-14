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

    <style>
        .content-container {
            overflow-y: auto;
            max-height: calc(100vh - 64px - 50px);
            margin-left: 16rem;
            padding-top: 4rem;
            padding-bottom: 50px;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .sidebar {
            position: fixed;
            top: 4rem;
            left: 0;
            height: calc(100vh - 4rem);
            width: 16rem;
            overflow-y: auto;
            z-index: 1000;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 50px;
            text-align: center;
            padding: 10px 0;
            z-index: 1000;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="flex">
        @include('layouts.sidebar')

        <div class="container content-container">
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
