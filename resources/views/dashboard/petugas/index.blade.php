<x-app-layout>
	<x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Petugas') }}
    </h2>
  </x-slot>
  <div class="card">
    <div class="mx-auto">
      <label for="add-modal" class="btn btn-md btn-primary modal-button"><i data-feather="plus-circle" class="mr-2"></i>Tambah Petugas</label>
    </div>
    <div class="card-body">
      <table class="table w-full table-compact">
        <thead>
          <tr>
            <th>Username</th>
            <th>nama</th>
            <th>Jenkel</th>
            <th>Jabatan</th>
            <th>Telp</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($petugass as $petugas)
          <tr>
            <td>{{$petugas->user->name}}</td>
            <td>{{$petugas->nama}}</td>
            <td>{{$petugas->jk}}</td>
            <td>{{$petugas->jabatan}}</td>
            <td>{{$petugas->telp}}</td>
            <td colspan="2">
              <form action="{{route('petugas.destroy',$petugas->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="btn-group">
                  <a href="{{route('petugas.edit',$petugas->id)}}" class="btn btn-sm btn-warning "><i data-feather="edit"></i></a>
                  <button type="submit" class="btn btn-sm btn-error"><i data-feather="trash-2"></i></button>
                </div>
              </form>
            </td>          
          </tr>
          @endforeach

        </tbody>
      </table>
      <div class="py-4">
        {{ $petugass->links() }}
      </div>
    </div>
  </div>

  {{-- add-modal --}}
  <input type="checkbox" id="add-modal" class="modal-toggle">
  <div class="modal overflow-y-auto grid sm:mx-auto lg:-mr-80">
    <div class="modal-box my-6 w-screen">
      <span class="text-xl font-bold">Tambah Petugas</span>
      <form action="{{route('petugas.store')}}" method="POST" class="py-4">
        @csrf
        <div class="form-control">
          <label class="label">
            <span class="label-text">Username</span>
          </label>
          <select name="user_id" class="select select-primary">
            {{-- disini pengennya habis milih user yg dijadikan petugas pas mau tambah baru lagi user yg sudah dipilih nda tampil --}}
            <option disabled selected >Pilih user untuk petugas</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->email}} - {{$user->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nama</span>
          </label>
          <input type="text" class="input input-primary" name="nama" placeholder="Masukan nama">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Jenis Kelamin</span>
          </label>
          <select name="jk" id="" class="select select-primary">
            <option disabled selected>Pilih Jenis Kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Jabatan</span>
          </label>
          <input type="text" class="input input-primary" name="jabatan" placeholder="Masukan jabatan">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Telp</span>
          </label>
          <input name="telp" type="number" placeholder="ex: 0808080808" class="input input-primary" />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Alamat</span>
          </label>
          <textarea class="textarea h-24 textarea-bordered textarea-primary" placeholder="Alamat" name="alamat"></textarea>
        </div>
        <div class="modal-action">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <label for="add-modal" class="btn btn-error">Tutup</label>
      </div>
    </x-app-layout>