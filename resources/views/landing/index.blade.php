@extends('layouts.landing')
@section('content')
    <div class="mx-auto px-0 md:px-12 lg:px-12">

        <div class="text-primary text-center">
            <div class="inline-block">
                <span class="uppercase text-5xl font-bold">perpus</span>
                <span class="uppercase text-5xl font-bold text-error">mulia</span>
                <div class="text-2xl uppercase">perpustakaan online universitas mulia</div>
            </div>
        </div>

        <div class="mx-auto py-12">
            <div class="relative">
                <form action="{{ route('landing.index') }}" method="get" class="mx-auto">
                    <input type="text" class="input input-bordered input-primary w-full" placeholder="Cari Judul"
                        name="search" value="{{ request()->search }}">
                    <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
                        <i data-feather="search"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-8 ">
            @foreach ($bukus as $buku)
                <div class="card text-center shadow-2xl">
                    <figure>
                        <img src="{{ $buku->cover }}" class="max-h-80">
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $buku->judul }}</h2>
                        <div class="jutify-center">
                            <span class="text-gray-400 text-sm block">Penulis</span>
                            <span>{{ $buku->pengarang }}</span>
                            <span class="text-gray-400 text-sm block">Penerbit</span>
                            <span>{{ $buku->penerbit }}</span>
                            <span class="text-gray-400 text-sm block">Tahun</span>
                            <span>{{ $buku->tahun_terbit }}</span>
                        </div>
                        <div class="justify-center card-actions">
                            <a href="{{ route('transaksi.pinjam', $buku->judul) }}"
                                class="btn btn-md btn-primary text-white">Pinjam</a>
                            <a href="{{ route('landing.show', $buku->id) }}" class="btn btn-md btn-ghost">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="px-2 py-4">
            {{ $bukus->links() }}

        </div>
    </div>
@endsection
