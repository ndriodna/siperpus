<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
          {{ __('Member') }}
      </h2>
  </x-slot>
  <div class="card">
    {{-- maunya sih member nda ush ditambah biar mereka regis trus edit bio datanya di profile --}}
    <div class="card-body">
      <table class="table w-full table-compact">
        <thead>
          <tr>
            <th>Username</th>
            <th>nama</th>
            <th>Jenkel</th>
            <th>Jurusan</th>
            <th>Telp</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach($members as $member)
      <tr>
        <td>{{$member->user->name}}</td>
        <td>{{$member->nama}}</td>
        <td>{{$member->jk}}</td>
        <td>{{$member->jurusan}}</td>
        <td>{{$member->telp}}</td>
        <td colspan="2">
          <form action="{{route('member.destroy',$member->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="btn-group">
              <a href="{{route('member.edit',$member->id)}}" class="btn btn-sm btn-warning "><i data-feather="edit"></i></a>
              <button type="submit" class="btn btn-sm btn-error"><i data-feather="trash-2"></i></button>
          </div>
      </form>
  </td>          
</tr>
@endforeach

</tbody>
</table>
<div class="py-4">
    {{ $members->links() }}
</div>
</div>
</div>

</x-app-layout>