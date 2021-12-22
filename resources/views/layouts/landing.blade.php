<!DOCTYPE html>
<html data-theme="cmyk" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'SiPerpus') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
  <div class="drawer drawer-mobile drawer-end">
    <input id="sidenav-mobile" type="checkbox" class="drawer-toggle">
    <main class="drawer-content">
      @include('landing.nav')
      <div class="max-w-screen mx-auto px-12">
            @yield('content')
      </div>
    </main>

    {{-- side nav for mobile --}}
    <div class="drawer-side ">
      <label for="sidenav-mobile" class="drawer-overlay"></label>
      @include('landing.sideMobile') 
    </div>
  </div>
</body>
</html>
