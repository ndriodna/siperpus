<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Petugas') }}
    </h2>
  </x-slot>

  <div class="lg:w-1/2 w-full mx-auto pb-4">
    <div class="relative">
      <form action="{{ route('petugas.index') }}" method="get">
        <input type="text" name="q" placeholder="Search" class="input input-primary w-full"
        value="{{ request()->q }}">
        <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
          <i data-feather="search"></i>
        </button>
      </form>
    </div>
  </div>
  <div class="p-6 overflow-x-auto ">
    <table class="w-full table table-compact">
      <thead>
        <tr>
          <th class="w-1/2">Nama</th>
          <th class="w-1/2">Username</th>
          <th class="w-1/2">Email</th>
          <th class="w-1/2">Level</th>
          <th class="w-1/2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->petugas->nama ?? '-' }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->level }}</td>
          @if ($user->level == 'member')
          <td colspan="2" class="flex justify-end">
            <label class="btn btn-sm btn-warning modal-button" for="modal{{ $user->id }}">
              <i data-feather="check"></i>
            </label>
            <input type="checkbox" id="modal{{ $user->id }}" class="modal-toggle">
            <div class="modal">
              <div class="modal-box">
                <p class="text-2xl">Ubah kelevel petugas ?</p>
                <div class="modal-action">
                  <form action="{{ route('role.petugas', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Ya</button>
                  </form>
                  <label for="modal{{ $user->id }}" class="btn">
                    Tidak
                  </label>
                </div>
              </div>
            </div>
          </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-4">
    {{ $users->links() }}
  </div>
</x-app-layout>
