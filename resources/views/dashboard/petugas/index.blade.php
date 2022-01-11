<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Petugas') }}
    </h2>
  </x-slot>

  <div class="w-full mx-auto pb-4">
    <form action="{{ route('petugas.index') }}" method="get">
      <div class="relative inset-y-0 flex items-center block">
        <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
        value="{{ request()->q }}">
        <select name="by" class="select select-primary rounded-l-none rounded-r-none">
          <option disabled selected>Cari berdasarkan</option>
          <option value="nama">Nama</option>
          <option value="jabatan">Jabatan</option>
        </select>
        <button class="btn btn-primary rounded-l-none">
          <i data-feather="search"></i>
        </button>
      </div>
    </form>
  </div>
  <div class="p-6 overflow-x-auto ">
    <table class="w-full table table-compact">
      <thead>
        <tr>
          <th></th>
          <th>Username</th>
          <th>Email</th>
          <th>Nama</th>
          <th>JenKel</th>
          <th>Jabatan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($petugas as $data)
        <tr>
          <td></td>
          <td>{{ $data->user->name }}</td>
          <td>{{ $data->user->email }}</td>
          <td>{{ $data->nama ?? '-' }}</td>
          <td>{{ $data->jk }}</td>
          <td>{{ $data->jabatan }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-4">
    {{ $petugas->links() }}
  </div>
</x-app-layout>
