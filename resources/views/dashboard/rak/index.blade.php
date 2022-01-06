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
      </div>
    </div>
    <div class="overflow-x-auto p-6 ">
      <table class="table table-compact w-full">
        <thead>
          <tr>
            <th>Nama Rak</th>
            <th class="flex justify-end">action</th>
          </tr>
        </thead>
        <tbody >
          @foreach ($raks as $rak)
          <tr>
            <td><a href="{{ route('rak.show', $rak->id) }}">{{ $rak->nama }}</a></td>
            <td colspan="2" class=" flex justify-end">
              <form action="{{ route('rak.destroy', $rak->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="btn-group">
                  <button type="submit" class="btn btn-sm btn-error"><i
                    data-feather="trash-2"></i></button>
                    <label class="btn btn-sm btn-warning modal-button" for="modal{{ $rak->id }}"><i
                      data-feather="edit"></i></label>
                    </div>
                  </form>
                </td>
              </tr>
              <input type="checkbox" id="modal{{ $rak->id }}" class="modal-toggle">
              <div class="modal">
                <div class="modal-box">
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
                    </form>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>

          <input type="checkbox" id="add-modal" class="modal-toggle">
          {{-- add modal --}}
          <div class="modal overflow-y-auto grid -mr-80">
            <div class="modal-box my-6 w-screen">
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
                </form>
              </div>
            </div>
          </div>

        </x-app-layout>
