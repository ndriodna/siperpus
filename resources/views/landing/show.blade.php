@extends('layouts.landing')
@section('content')
    <div class="mx-auto px-12">

        <div class="card lg:card-side shadow-lg bg-base-100">
            <figure>
                <img src="{{ $buku->cover ? asset($buku->cover) : asset('cover-default.svg') }}" alt=""
                    class="max-h-fit">
            </figure>
            <div class="card-body">
                <span class="text-3xl font-medium">{{ $buku->judul }}</span>
                <span class="text-gray-600 py-2 underline italic">{{ $buku->pengarang }}</span>
                <div class="my-4">
                    <section class="mb-2">
                        <div class="lg:inline-block lg:w-2/12 text-gray-500">Tahun :</div>
                        <div class="lg:inline-block lg:w-8/12 w-full">{{ $buku->tahun_terbit }}</div>
                    </section>
                    <section class="mb-2">
                        <div class="lg:inline-block lg:w-2/12 text-gray-500">Penerbit :</div>
                        <div class="lg:inline-block lg:w-8/12 w-full">{{ $buku->penerbit }}</div>
                    </section>
                    <section class="mb-2">
                        <div class="lg:inline-block lg:w-2/12 text-gray-500">ISBN :</div>
                        <div class="lg:inline-block lg:w-8/12 w-full">{{ $buku->isbn }}</div>
                    </section>
                </div>
                <div class="card-actions">
                    <form action="#">
                        <div data-tip="Stok : {{ $buku->stok }}" class="tooltip tooltip-bottom">
                            <button type="submit" {{ $buku->stok > 0 ? '' : 'disabled' }}
                                class="btn btn-primary">Pinjam</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
