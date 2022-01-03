<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>
    <div class="form-control">
        <form action="{{ route('transaksi.store') }}" method="post">
            @csrf
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
                    </div>
                </div>
            </div>
            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
            <div class=" form-control my-2">
                <label class="label">
                    <span class="label-text">Tanggal Kembali</span>
                </label>
                <input type="date" name="tgl_kembali" class="input input-primary">
            </div>
            <div class="py-2">
                <button class="btn btn-warning" type="submit">Ajukan Peminjaman</button>
            </div>
        </form>
    </div>
</x-app-layout>
