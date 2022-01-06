<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('User List') }}
    </h2>
  </x-slot>
  
  <div class="p-6 overflow-x-auto ">
    <div class="w-1/4 pb-4">
      <div class="relative">
        <form action="{{ route('user.index') }}" method="get">
          <input type="text" name="q" placeholder="Search" class="input input-primary w-full"
          value="{{ request()->q }}">
          <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
            <i data-feather="search"></i>
          </button>
        </form>
      </div>
    </div>
    <table class="table table-fixed w-full table-compact">
      <thead>
        <tr>
          <th class="w-1/2">Username</th>
          <th class="w-1/2">Email</th>
          <th class="w-1/2">Role</th>
          <th class="w-1/2">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->level }}</td>
          <td colspan="2">
            @if(Auth::user()->level == 'admin')
            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <div class="btn-group">
                <label class="btn btn-sm btn-warning" for="modal{{$user->id}}"><i
                  data-feather="edit"></i></label>
                  <button type="submit" class="btn btn-sm btn-error"><i
                    data-feather="trash-2"></i></button>
                  </div>
                </form>
                @endif
              </td>
            </tr>
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