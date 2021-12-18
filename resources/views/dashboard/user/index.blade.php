<x-app-layout>
	<x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Profile') }}
    </h2>
  </x-slot>
  <div class="form-control">
    <form action="#" method="post">
      @csrf
      <div class="form-control my-2">
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input type="text" class="input input-primary" value="{{$currentUser->name}}">
      </div>
      <div class="form-control my-2">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input type="mail" class="input input-primary" value="{{$currentUser->email}}">
      </div>

      {{-- ini maunya nampil buat level petugas dan member aja admin nda ush --}}
     <div class="mt-12 mx-auto ">
        <span class=" my-4 menu-title">Bio Data</span>
        <hr class="border-t border-base-700">
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
        <div class="py-6">
          <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-error">Reset</button>
        </div>
        </form>
    </form>
  </div>
  </div>
</x-app-layout>