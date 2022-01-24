<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Rak') }}
    </h2>
  </x-slot>
  <div class="card">
    <div class="mx-auto">
      <label class="btn btn-md btn-primary modal-button" for="add-modal"><i data-feather="plus-circle"
        class="mr-2"></i>Tambah Rak</label>
        {{-- add modal --}}
        <input type="checkbox" id="add-modal" class="modal-toggle">
        <div class="modal overflow-y-auto grid lg:-mr-80">
          <div class="modal-box w-screen">
            <span class="text-xl font-bold">Tambah Rak</span>
            <form action="{{ route('rak.store') }}" method="POST">
              @csrf
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Nama Rak</span>
                </label>
                <input type="text" class="input input-primary" name="nama" placeholder="Masukan nama rak">
              </div>
              <div class="modal-action">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <label for="add-modal" class="btn btn-error">Tutup</label>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full mx-auto py-4">
      <form action="{{ route('rak.index') }}" method="get">
        <div class="relative inset-y-0 flex items-center block">
          <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
          value="{{ request()->q }}">
          <button class="btn btn-primary rounded-l-none">
            <i data-feather="search"></i>
          </button>
        </div>
      </form>
    </div>
    <div class="overflow-x-auto p-6 ">
      <table class="table table-compact w-full">
        <thead>
          <tr>
            <th>Nama Rak</th>
            <th class="flex justify-end">action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($raks as $rak)
          <tr>
            <td><a href="{{ route('rak.show', $rak->id) }}">{{ $rak->nama }}</a></td>
            <td colspan="2" class=" flex justify-end">
              <div class="btn-group">
                <label class="btn btn-sm btn-warning modal-button" for="modal{{ $rak->id }}"><i data-feather="edit"></i></label>
                <label class="btn btn-sm btn-error modal-button" for="delete-modal{{ $rak->id }}"><i data-feather="trash-2"></i></label>
              </div>
            </td>
          </tr>
          {{-- delete modal --}}
          <input type="checkbox" id="delete-modal{{ $rak->id }}" class="modal-toggle">
          <div class="modal">
            <div class="modal-box">
              <div class="text-xl font-bold">Hapus Rak - {{$rak->nama}}</div>
              <form action="{{ route('rak.destroy', $rak->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-action">
                  <button type="submit" class="btn btn-error">Hapus</button>
                  <label for="delete-modal{{$rak->id}}" class="btn">Batal</label>  
                </div>
              </form>
            </div>
          </div>
          {{-- edit modal --}}
          <input type="checkbox" id="modal{{ $rak->id }}" class="modal-toggle">
          <div class="modal">
            <div class="modal-box">
              <div class="text-xl font-bold">Edit Rak</div>
              <form action="{{route('rak.update',$rak->id)}}" method="POST" class="w-1/2 mx-auto">
                @csrf
                @method('PUT')
                <div class="form-control">
                  <label class="label">
                    <span class="label-text">Nama Rak</span>
                  </label>
                  <input type="text" class="input input-primary" name="nama" value="{{$rak->nama}}">
                </div>
                <div class="modal-action">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <label for="modal{{$rak->id}}" class="btn btn-error">Tutup</label>
                </div>
              </form>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="py-4">
      {{ $raks->links() }}
    </div>
  </x-app-layout>
