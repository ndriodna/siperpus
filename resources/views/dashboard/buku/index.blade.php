<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Buku') }}
    </h2>
  </x-slot>
  {{-- anjim pake card baru mau ketengah btn nya --}}
  <div class="card">
    <div class="mx-auto">
      <label class="btn btn-md btn-primary" for="add-modal">
        <i data-feather="plus-circle" class="mr-2"></i>
        Tambah Buku
      </label>
    </div>
  </div>
  <div class="p-6">
    <div class="lg:w-1/2 w-full mx-auto pb-4">
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
      <table class="w-full table-compact">
        <thead>
          <tr>
            <th class="w-3/12">Judul</th>
            <th class="w-1/12">ISBN</th>
            <th class="w-1/12">Pengarang</th>
            <th class="w-1/12">Penerbit</th>
            <th class="w-1/12">Thn</th>
            <th class="w-1/12">Stok</th>
            <th class="w-1/12">Rak</th>
            <th class="w-2/12">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
          @foreach ($bukus as $buku)
          <tr>
            <td class="px-6 py-4">{{ $buku->judul }}</td>
            <td class="px-6 py-4">{{ $buku->isbn }}</td>
            <td class="px-6 py-4">{{ $buku->pengarang }}</td>
            <td class="px-6 py-4">{{ $buku->penerbit }}</td>
            <td class="px-6 py-4">{{ $buku->tahun_terbit }}</td>
            <td class="px-6 py-4">{{ $buku->stok }}</td>
            <td class="px-6 py-4">{{ $buku->rak->nama }}</td>
            @if (Auth::user()->level != 'member')
            <td class="px-6 py-4" colspan="2">
              <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <label class="btn btn-sm btn-warning" for="modal{{$buku->id}}"><i data-feather="edit"></i></label>
                <button type="submit" class="btn btn-sm btn-error"><i
                  data-feather="trash-2"></i></button>
                </form>
              </td>
              @endif
            </tr>
            @include('dashboard.buku.edit')
            
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
