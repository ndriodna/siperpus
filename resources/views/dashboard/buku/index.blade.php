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
    <div class="w-full mx-auto pb-4">
      <form action="{{ route('buku.index') }}" method="get">
        <div class="relative inset-y-0 flex items-center block">
          <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
          value="{{ request()->q }}">
          <select name="by" class="select select-primary rounded-l-none rounded-r-none">
            <option disabled selected>Cari berdasarkan</option>
            <option value="judul">Judul</option>
            <option value="isbn">ISBN</option>
            <option value="pengarang">Penulis</option>
            <option value="penerbit">Penerbit</option>
            <option value="tahun_terbit">Tahun</option>
            <option value="stok">Stok</option>
          </select>
          <button class="btn btn-primary rounded-l-none">
            <i data-feather="search"></i>
          </button>
        </div>
      </form>
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
      <div class="modal-box w-screen">
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
