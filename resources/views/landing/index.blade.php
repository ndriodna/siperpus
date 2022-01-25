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

        <div class="w-full mx-auto py-4">
            <form action="{{ route('landing.index') }}" method="get">
                <div class="relative inset-y-0 flex items-center block">
                    <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
                        value="{{ request()->q }}">
                    <select name="by" class="select select-primary rounded-l-none rounded-r-none">
                        <option disabled selected> {{ request()->by ?? 'Cari berdasarkan' }}</option>
                        <option value="judul">Judul</option>
                        <option value="isbn">ISBN</option>
                        <option value="pengarang">Penulis</option>
                        <option value="penerbit">Penerbit</option>
                        <option value="tahun_terbit">Tahun</option>
                    </select>
                    <button class="btn btn-primary rounded-l-none">
                        <i data-feather="search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:mx-0 md:mx-0 mx-4">
            @foreach ($bukus as $buku)
                <div class="card text-center shadow-2xl">
                    <figure>
                        <img src="{{ $buku->cover }}" class="max-h-72">
                    </figure>
                    <h2 class="card-title mt-4 -mb-4">{{ $buku->judul }}</h2>
                    <div class="card-body">
                        <div class="jutify-center">
                            <span class="text-gray-400 text-sm block">Penulis</span>
                            <span>{{ $buku->pengarang }}</span>
                            <span class="text-gray-400 text-sm block">Penerbit</span>
                            <span>{{ $buku->penerbit }}</span>
                            <span class="text-gray-400 text-sm block">Tahun</span>
                            <span>{{ $buku->tahun_terbit }}</span>
                        </div>
                        <div class="justify-center card-actions">
                            {{-- @can('pinjam_buku') --}}
                            <a href="{{ route('transaksi.pinjam', $buku->slug) }}"
                                class="btn btn-md btn-primary text-white">Pinjam</a>
                            {{-- @endcan --}}
                            <a href="{{ route('landing.show', $buku->slug) }}" class="btn btn-md btn-ghost">Lihat
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
