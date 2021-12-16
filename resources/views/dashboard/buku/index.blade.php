<x-app-layout>
	<x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Buku') }}
    </h2>
  </x-slot>
  <div class="mx-auto py-4">
    <label class="btn btn-md btn-primary modal-button" for="add-modal"><i data-feather="plus-circle" class="mr-2"></i>Tambah Buku</label>
  </div>
  <div class="overflow-x-auto p-6 ">
    <table class="table w-full table-compact">
      <thead>
        <tr>
          <th>Judul</th>
          <th>isbn</th>
          <th>pengarang</th>
          <th>penerbit</th>
          <th>Thn</th>
          <th>stok</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bukus as $buku)
        <tr>
          <td>{{$buku->judul}}</td>
          <td>{{$buku->isbn}}</td>
          <td>{{$buku->pengarang}}</td>
          <td>{{$buku->penerbit}}</td>
          <td>{{$buku->tahun_terbit}}</td>
          <td>{{$buku->stok}}</td>
          <td colspan="2">
            <form action="#" method="POST">
              @csrf
              @method('DELETE')
              <div class="btn-group">
                <button type="submit" class="btn btn-md btn-error"><i data-feather="trash-2"></i></button>
              </div>
            </form>
          </td>          
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

 <input type="checkbox" id="add-modal" class="modal-toggle">
    {{-- add modal --}}
    <div class="modal overflow-y-auto grid -mr-80">
      <div class="modal-box my-6 w-screen">
        <span class="text-xl font-bold">Tambah Buku</span>
        <div>
          <form action="{{route('buku.store')}}" method="POST">
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
            <input type="text" class="input input-primary" name="pengarang" placeholder="Masukan nama pengarang">
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Penerbit</span>
            </label>
            <input type="text" class="input input-primary" name="penerbit" placeholder="Masukan nama penerbit">
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Tahun</span>
            </label>
            <input type="month" class="input input-primary" name="tahun_terbit" placeholder="Masukan tahun terbit">
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
            <select name="rak_id" id="">
              @foreach($bukus as $data)
              <option value="{{$data->rak->id}}">{{$data->rak->lokasi}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          <label for="add-modal" class="btn btn-error">Tutup</label>
        </div>
      </div>
    </div>

</x-app-layout>