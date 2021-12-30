@if(Auth::user()->level == 'admin')
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
            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <div class="btn-group">
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning "><i
                  data-feather="edit"></i></a>
                  <button type="submit" class="btn btn-sm btn-error"><i
                    data-feather="trash-2"></i></button>
                  </div>
                </form>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="py-4">
          {{ $users->links() }}
        </div>
      </div>
</x-app-layout>

@endif