<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Member') }}
    </h2>
  </x-slot>
  <div class="overflow-x-auto my-4">
    <table class="w-full table table-compact">
      <thead>
        <tr>
          <th></th>
          <th class="w-1/6">Username</th>
          <th class="w-1/6">nama</th>
          <th class="w-1/6">Jenkel</th>
          <th class="w-1/6">Jurusan</th>
          <th class="w-1/6">Telp</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-grey-300">
        @foreach($members as $member)
        <tr>
          <th></th>
          <td>{{$member->user->name}}</td>
          <td>{{$member->nama}}</td>
          <td>{{$member->jk}}</td>
          <td>{{$member->jurusan}}</td>
          <td>{{$member->telp}}</td>          
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
  <div class="py-4">
    {{ $members->links() }}
  </div>

</x-app-layout>