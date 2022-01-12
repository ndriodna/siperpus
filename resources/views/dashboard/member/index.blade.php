<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Member') }}
    </h2>
  </x-slot>
  <div class="w-full mx-auto pb-4">
    <form action="{{ route('member.index') }}" method="get">
      <div class="relative inset-y-0 flex items-center block">
        <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
        value="{{ request()->q }}">
        <select name="by" class="select select-primary rounded-l-none rounded-r-none">
          <option disabled selected>Cari berdasarkan</option>
          <option value="nim">NIM</option>
          <option value="nama">Nama</option>
          <option value="jurusan">Jurusan</option>
        </select>
        <button class="btn btn-primary rounded-l-none">
          <i data-feather="search"></i>
        </button>
      </div>
    </form>
  </div>
  <div class="overflow-x-auto my-4">
    <table class="w-full table table-compact">
      <thead>
        <tr>
          <th></th>
          <th>Username</th>
          <th>Email</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Jenkel</th>
          <th>Jurusan</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-grey-300">
        @foreach($members as $member)
        <tr>
          <th></th>
          <td>{{$member->user->name}}</td>
          <td>{{$member->user->email}}</td>
          <td>{{$member->nim}}</td>
          <td>{{$member->nama}}</td>
          <td>{{$member->jk}}</td>
          <td>{{$member->jurusan}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-4">
    {{ $members->links() }}
  </div>

</x-app-layout>