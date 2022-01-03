<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Buku') }}
        </h2>
    </x-slot>
    @if (Auth::user()->level != 'member')
        <div class="mx-auto py-4">
            <label class="btn btn-md btn-primary modal-button" for="add-modal">
                <i data-feather="plus-circle" class="mr-2"></i>
                Tambah Buku
            </label>
        </div>
    @endif
    <div class="p-6">
        <div class="w-1/4 pb-4">
            <div class="relative">
                <form action="{{ route('buku.index') }}" method="get">
                    <input type="text" name="q" placeholder="Search" class="input input-primary w-full"
                        value="{{ request()->q }}">
                    <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
                        <i data-feather="search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto ">
            <table class="table-fixed w-full table-compact">
                <thead>
                    <tr>
                        <th class="w-10/12">Judul</th>
                        <th class="w-1/2">ISBN</th>
                        <th class="w-1/2">Pengarang</th>
                        <th class="w-1/2">Penerbit</th>
                        <th class="w-1/4">Thn</th>
                        <th class="w-1/4">Stok</th>
                        <th class="w-1/4">Rak</th>
                        <th class="w-1/2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->isbn }}</td>
                            <td>{{ $buku->pengarang }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->stok }}</td>
                            <td>{{ $buku->rak->nama }}</td>
                            @if (Auth::user()->level != 'member')
                                <td colspan="2">
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('buku.edit', $buku->id) }}"
                                            class="btn btn-sm btn-warning "><i data-feather="edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-error"><i
                                                data-feather="trash-2"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="py-4">
            {{ $bukus->links() }}
        </div>
    </div>

    {{-- add modal --}}
    <input type="checkbox" id="add-modal" class="modal-toggle">
    <div class="modal overflow-y-auto grid sm:mx-auto lg:-mr-80">
        <div class="modal-box my-6 w-screen">
            <span class="text-xl font-bold">Tambah Buku</span>
            <div>
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Judul</span>
                        </label>
                        <input type="text" class="input input-primary" name="judul" placeholder="Masukan Judul"
                            required>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">ISBN</span>
                        </label>
                        <input type="text" class="input input-primary" name="isbn" placeholder="Masukan isbn">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Pengarang</span>
                        </label>
                        <input type="text" class="input input-primary" name="pengarang"
                            placeholder="Masukan nama pengarang">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Penerbit</span>
                        </label>
                        <input type="text" class="input input-primary" name="penerbit"
                            placeholder="Masukan nama penerbit">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tahun</span>
                        </label>
                        <input name="tahun_terbit" type="number" min="1990" max="2099" step="1" placeholder="ex: 2018"
                            class="input input-primary" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Stok</span>
                        </label>
                        <input type="number" class="input input-primary" name="stok" min="0" max="99" step="1"
                            placeholder="Masukan jumlah stok" required>
                        <label class="label">
                            <span class="label-text-alt text-error">Min: 0, Max: 99</span>
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Cover</span>
                        </label>
                        <input type="file" class="input input-primary" name="cover">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Rak</span>
                        </label>
                        <select name="rak_id" id="" class="select select-bordered select-primary" required>
                            <option disabled selected>Pilih Rak Buku</option>
                            @foreach ($raks as $rak)
                                <option value="{{ $rak->id }}" req>{{ $rak->nama }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <label for="add-modal" class="btn btn-error">Tutup</label>
            </div>

</x-app-layout>
