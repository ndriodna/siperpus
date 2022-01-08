<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>
  {{-- alert user login --}}
  <div class="w-full pb-4">
    <div class="alert alert-info">
      <div class="flex-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        class="w-6 h-6 mx-2 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <Label>Selamat datang <span class="text-error capitalize">{{auth()->user()->name}}</span></Label>
    </div>
  </div>
</div>

{{-- alert trasaction pending --}}
<div class="pb-4">
  <div class="alert">
    <div class="flex-1">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688" class="flex-shrink-0 w-6 h-6 mx-2">     
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
      </svg> 
      <label class="text-left">
        <h4>Notifikasi</h4> 
        <p class="text-md text-base-content text-opacity-60">
          @if (Auth::user()->level != 'member')
          @if($transaksi->count() <= 0)
          Tidak ada pemberitahuan
          @else
          Anda memiliki <span class="text-error text-xl font-bold">{{$transaksi->count()}}</span> transaksi menunggu verifikasi
          @endif
          @endif
          <!--alert member-->
          @if(Auth::user()->level == 'member')
          <p class="text-md text-base-content text-opacity-60">
            @if($onlyAuthMember->count() <= 0)
            Tidak ada pemberitahuan
            @else
            Anda memiliki {{$onlyAuthMember->count()}} transaksi menunggu verifikasi
            @endif
            @endif
          </p>
        </label>
      </div> 
    </div>
  </div>
  @if (Auth::user()->level == 'member' && auth::user()->member->nim == '')
  <div class="hero min-h-screen bg-base-200">
    <div class="text-center hero-content">
      <div class="max-w-md">
        <h1 class="mb-5 text-3xl font-bold">
          Halo, Selamat Datang
        </h1>
        <p class="mb-5">
          Silahkan lengkapi profile anda untuk bisa melakukan peminjaman buku
        </p>
        <a href="{{ route('profile.index') }}" class="btn btn-primary text-white">Lengkapi Profile</a>
      </div>
    </div>
  </div>
  @endif
</x-app-layout>
