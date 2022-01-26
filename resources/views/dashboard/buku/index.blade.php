<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Buku') }}
    </h2>
  </x-slot>

  <div class="card">
    <div class="mx-auto">
      <label class="btn btn-md btn-primary" for="add-modal">
        <i data-feather="plus-circle" class="mr-2"></i>
        Tambah Buku
      </label>
    </div>
    <input type="checkbox" id="add-modal" class="modal-toggle">
    <div class="modal overflow-y-auto grid sm:mx-auto lg:-mr-80">
      <div class="modal-box w-screen">
        <span class="text-xl font-bold">Tambah Buku</span>
        <form action="{{route('buku.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-control">
            <label class="label"><span class="label-text">Judul <span class="text-error">*</span></span></label>
            <input type="text" class="input input-primary" name="judul" placeholder="Masukan Judul" required>
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">ISBN</span></label>
            <input type="text" class="input input-primary" name="isbn" placeholder="978-602-xxxx-xx-x">
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Pengarang</span></label>
            <input type="text" class="input input-primary" name="pengarang" placeholder="Masukan Nama Pengarang">
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Penerbit</span></label>
            <input type="text" class="input input-primary" name="penerbit" placeholder="Masukan Nama Penerbit">
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Tahun</span></label>
            <input type="number" class="input input-primary" name="tahun_terbit" min="1900" max="2099" step="1" placeholder="Ex: 2015">
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Stok <span class="text-error">*</span></span></label>
            <input type="number" class="input input-primary" name="stok" min="0" max="99" step="1" placeholder="Min: 0, Max: 99" required>
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Cover</span></label>
            <input type="file" class="input input-primary" name="cover">
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Kategori <span class="text-error">*</span></span></label>
            <select name="kategori_id" class="select select-bordered select-primary" required>
              <option disabled="disabled" selected="selected" value="">Pilih Kategori Buku</option>
              @foreach($kategoris as $kategori)
              <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-action">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <label for="add-modal" class="btn btn-error">Tutup</label>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="w-full mx-auto py-4">
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
          <th class="w-1/12">Kategori</th>
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
          <td class="px-6 py-4">{{ $buku->kategori->nama }}</td>
          @if (Auth::user()->level != 'member')
          <td class="px-6 py-4" colspan="2">
            <label class="btn btn-sm btn-warning" for="modal{{$buku->id}}"><i data-feather="edit"></i></label>
            <label class="btn btn-sm btn-error" for="delete-modal{{$buku->id}}"><i data-feather="trash-2"></i></label>
          </td>
          @endif
        </tr>
        {{-- edit dan delete modal--}}
        @include('dashboard.buku.edit')

        @endforeach

      </tbody>
    </table>
  </div>
  <div class="py-4">
    {{ $bukus->links() }}
  </div>

</x-app-layout>
