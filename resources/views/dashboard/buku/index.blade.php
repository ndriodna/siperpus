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
  <div class="p-6 overflow-x-auto ">
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
    <table class="table w-full table-compact">
      <thead>
        <tr>
          <th>Judul</th>
          <th>ISBN</th>
          <th>Pengarang</th>
          <th>Penerbit</th>
          <th>Thn</th>
          <th>Stok</th>
          <th>Rak</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bukus as $buku)
        <tr>
          <td class="flex flex-wrap">{{ $buku->judul }}</td>
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
              <div class="btn-group">
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning "><i
                  data-feather="edit"></i></a>
                  <button type="submit" class="btn btn-sm btn-error"><i
                    data-feather="trash-2"></i></button>
                  </div>
                </form>
              </td>
              @endif
                 @if(Auth::user()->level == 'member')
              <td>
                <form action="#" method="post">
                  @csrf
                  <button class="btn btn-md btn-success" type="submit">Pinjam</button>
                </form>
              </td>
                @endif
            </tr>
            @endforeach

          </tbody>
        </table>
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
            <form action="{{ route('buku.store') }}" method="POST">
              @csrf
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Judul</span>
                </label>
                <input type="text" class="input input-primary" name="judul" placeholder="Masukan Judul">
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
                <input type="number" class="input input-primary" name="stok" placeholder="Masukan jumlah stok">
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
                <select name="rak_id" id="" class="select select-bordered select-primary">
                  <option disabled selected>Pilih Rak Buku</option>
                  @foreach ($raks as $rak)
                  <option value="{{ $rak->id }}">{{ $rak->nama }}</option>
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
