<!DOCTYPE html>
<html data-theme="cmyk" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PERPUSMULIA') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">

    <div class="drawer drawer-mobile">
        <input id="dashboard" type="checkbox" class="drawer-toggle">

        <!-- Page Content -->
        <main class="drawer-content bg-base-100">
            {{-- top nav mobile --}}
            @include('layouts.nav')

            {{-- top nav --}}
            <div class="bg-base-100 mx-auto navbar sticky inset-x-0 top-0 z-50 shadow">
                <div class="flex-1 px-2 mx-2">
                    <span class="text-lg font-bold">
                        {{ $header }}
                    </span>
                </div>
                <div class="relative">
                    @include('layouts.signOut')
                </div>
            </div>

            {{-- content --}}
            <div class="max-w-screen mx-auto">
                <div class="px-6 py-4">
                    {{ $slot }}
                </div>
            </div>
            @include('sweetalert::alert')

        </main>

        {{-- side nav --}}
        <div class="drawer-side">
            <label for="dashboard" class="drawer-overlay"></label>
            @include('layouts.sideNavigation')
        </div>
    </div>

</body>

</html>
