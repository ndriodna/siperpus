<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>
    <div class="form-control">
        <form action="{{ route('transaksi.store') }}" method="post">
            @csrf
            <div class="mx-auto px-4">

                <div class="card lg:card-side md:card-side shadow-lg bg-base-100">
                    <figure>
                        <img src="{{ $buku->cover }}" alt=""
                        class="max-h-80">
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
            <div class="my-4 space-y-4">
                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                <div class="flex justify-center">
                    <label class="text-xl font-medium">Pilih Berapa Hari Peminjaman</label>
                </div>
                <div class="flex justify-center space-x-2">
                    <div class="grid grid-cols-3 md:grid-cols-7 lg:grid-cols-7 gap-2">
                        @for($i = 1; $i <= 7; $i++)
                        <label for="modal-hari{{$i}}" class="btn btn-outline modal-button">{{$i}} Hari</label> 
                        <input type="checkbox" id="modal-hari{{$i}}" class="modal-toggle"> 
                        <div class="modal">
                          <div class="modal-box">
                            <label class="text-xl">Anda memilih {{$i}} Hari Peminjaman</label>
                            <input type="hidden" name="hari" value="{{$i}}">
                            <div class="modal-action">
                                <button class="btn btn-primary" type="submit">Ajukan Peminjaman</button> 
                                <label for="modal-hari{{$i}}" class="btn">Batal</label>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </form>
</div>
</x-app-layout>
