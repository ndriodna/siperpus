<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('User List') }}
    </h2>
  </x-slot>
  
  <div class="w-full mx-auto py-4">
    <form action="{{ route('user.index') }}" method="get">
      <div class="relative inset-y-0 flex items-center block">
        <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
        value="{{ request()->q }}">
        <select name="by" class="select select-primary rounded-l-none rounded-r-none">
          <option disabled selected>Cari berdasarkan</option>
          <option value="name">Username</option>
          <option value="email">Email</option>
          <option value="level">Role</option>
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
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
         <td class="flex justify-start">
           @if ($user->level == 'member')
           <label class="btn btn-sm btn-primary modal-button" for="modal-uplevel{{ $user->id }}"><i data-feather="chevrons-up"></i>
           </label>
           @endif
         </td>
         <td>{{ $user->name }}</td>
         <td>{{ $user->email }}</td>
         <td>{{ $user->level }}</td>
         <td colspan="2">
          <label class="btn btn-sm btn-warning" for="modal{{$user->id}}"><i data-feather="edit"></i></label>
          @if($user->level != 'admin')
          <label class="btn btn-sm btn-error" for="modal-delete{{$user->id}}"><i data-feather="trash-2"></i></label>
          @endif
        </td>
      </tr>

      {{-- modal up level member to petugas --}}
      <input type="checkbox" id="modal-uplevel{{ $user->id }}" class="modal-toggle">
      <div class="modal">
        <div class="modal-box">
          <p class="text-2xl">Ubah kelevel petugas ?</p>
          <div class="modal-action">
            <form action="{{ route('role.petugas', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-primary">Ya</button>
            </form>
            <label for="modal-uplevel{{ $user->id }}" class="btn">
              Tidak
            </label>
          </div>
        </div>
      </div>

      {{-- modal delete --}}
      <input type="checkbox" id="modal-delete{{$user->id}}" class="modal-toggle">
      <div class="modal">
        <div class="modal-box">
          <p class="text-2xl font-bold">Hapus User - {{$user->name}} ?</p>
          <form action="{{ route('user.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-action">
              <button type="submit" class="btn btn btn-error">Ya</button>
              <label class="btn btn btn-warning" for="modal-delete{{$user->id}}">Batal</label>
            </div>
          </form>
        </div>
      </div>

      {{-- modal edit user --}}
      <input type="checkbox" id="modal{{$user->id}}" class="modal-toggle">
      <div class="modal">
        <div class="modal-box">
          <span class="text-xl font-bold">Edit User {{$user->name}}</span>
          <div>
            <form action="{{ route('user.update', $user->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="form-control my-2">
                <label class="label">
                  <span class="label-text">Username</span>
                </label>
                <input type="text" name="name" class="input input-primary" value="{{ $user->name }}">
              </div>
              <div class="form-control my-2">
                <label class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="mail" name="email" class="input input-primary" value="{{ $user->email }}">
              </div>
              <div class="form-control my-2">
                <label class="label">
                  <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" class="input input-primary">
                <label class="label">
                  <span class="label-text-alt text-error">kosongkan jika tidak merubah password</span>
                </label>
              </div>
              <div class="modal-action">
                <button type="submit" class="btn btn-warning">Update User</button>
                <label for="modal{{$user->id}}" class="btn">Batal</label>
              </div>
              <div class="py-2">
              </div>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
  <div class="py-4">
    {{ $users->links() }}
  </div>
</div>
</x-app-layout>