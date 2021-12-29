<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>
    <div class="hero min-h-screen bg-base-200">
        <div class="text-center hero-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">
                    Halo, {{ Auth::user()->member->nama }}
                </h1>
                <p class="mb-5">
                    Anda belum memiliki transaksi peminjaman buku, silahkan pinjam buku terlebih dahulu jika ingin
                    melanjutkan
                </p>
                <a href="{{ route('landing.index') }}" class="btn btn-primary">Pinjam Buku</a>
            </div>
        </div>
    </div>
</x-app-layout>
