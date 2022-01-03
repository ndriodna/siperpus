<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (Auth::user()->level == 'member')
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
