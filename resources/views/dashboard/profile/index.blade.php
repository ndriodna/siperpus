<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Profile') }} - {{Auth::user()->name}}
    </h2>
  </x-slot>
  <div class="form-control">
    <form action="{{route('user.update',Auth::user()->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="form-control my-2">
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input type="text" name="name" class="input input-primary" value="{{ $currentUser->name }}">
      </div>
      <div class="form-control my-2">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input type="mail" name="email" class="input input-primary" value="{{ $currentUser->email }}">
      </div>
      <div class="py-2">
        <button class="btn btn-warning">Update User</button>
      </div>
    </form>

    {{-- form bio --}}
    @if (Auth::user()->level != 'admin')
    <form action="{{ route('profile.store') }}" method="post">
      @csrf
      <div class="mt-12 mx-auto ">
        <span class=" my-4 menu-title capitalize">{{Auth::user()->level}} Data</span>
        <hr class="border-t border-base-700">
        @if (Auth::user()->level == 'member')
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nim</span>
          </label>
          <input type="text" class="input input-primary" name="nim" placeholder="Masukan nim"
          value="{{ auth::user()->member->nim ?? '' }}">
        </div>
        @endif
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nama</span>
          </label>
          <input type="text" class="input input-primary" name="nama" placeholder="Masukan nama"
          value="{{ auth::user()->member->nama ?? (auth::user()->petugas->nama ?? '') }}">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Jenis Kelamin</span>
          </label>
          <select name="jk" id="" class="select select-primary">
            <option>{{auth::user()->member->jk ?? (auth::user()->petugas->jk ?? 'Pilih Jenis Kelamin')}}</option>
            <option value="L">Laki-laki </option>
            <option value="P">Perempuan</option>
          </select>

        </div>
        @if (Auth::user()->level == 'member')
        <div class="form-control">
          <label class="label">
            <span class="label-text">Jurusan</span>
          </label>
          <input type="text" class="input input-primary" name="jurusan" placeholder="Masukan nama"
          value="{{ auth::user()->member->jurusan ?? '' }}">
        </div>
        @endif
        @if (Auth::user()->level != 'member')
        <div class="form-control">
          <label class="label">
            <span class="label-text">Jabatan</span>
          </label>
          <input type="text" class="input input-primary" name="jabatan" placeholder="Masukan jabatan"
          value="{{ auth::user()->petugas->jabatan ?? '' }}">
        </div>
        @endif
        <div class="form-control">
          <label class="label">
            <span class="label-text">Telp</span>
          </label>
          <input name="telp" type="number" placeholder="ex: 0808080808" class="input input-primary"
          value="{{ auth::user()->member->telp ?? (auth::user()->petugas->telp ?? '') }}" />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Alamat</span>
          </label>
          <textarea class="textarea h-24 textarea-bordered textarea-primary" placeholder="Alamat"
          name="alamat">{{ auth::user()->member->alamat ?? (auth::user()->petugas->alamat ?? '') }}</textarea>
        </div>
        <div class="py-6">
          <button type="submit" class="btn btn-primary">Update Profile</button>
          <button type="reset" class="btn btn-error">Reset</button>
        </div>
      </div>
    </form>
    @endif
  </div>
</x-app-layout>
