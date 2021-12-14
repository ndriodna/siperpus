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
<body class="font-sans antialiased">
    
  <div class="drawer drawer-mobile">
    <input id="dashboard" type="checkbox" class="drawer-toggle">
    
    <!-- Page Content -->
    <main class="drawer-content bg-base-100">
      {{-- top nav mobile --}}
        @include('layouts.nav')

      {{-- top nav --}}
      <header class="bg-base-100 mx-auto navbar">
          {{ $header }}
      </header>

      {{-- content --}}
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="p-6">
            {{$slot}}
          </div>
        </div>
      </div>

    </main>

    {{-- side nav --}}
    <div class="drawer-side">
      <label for="dashboard" class="drawer-overlay"></label> 
      @include('layouts.sideNavigation')
    </div>
  </div>

  {{-- <div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div> --}}
</body>
</html>
