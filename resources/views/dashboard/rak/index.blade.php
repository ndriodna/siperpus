<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Rak') }}
        </h2>
    </x-slot>
    <div class="mx-auto py-4">
        <label class="btn btn-md btn-primary modal-button" for="add-modal"><i data-feather="plus-circle"
                class="mr-2"></i>Tambah Rak</label>
    </div>
    <div class="overflow-x-auto p-6 ">
        <table class="table w-full">
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
                        <td colspan="2">
                            <form action="{{ route('rak.destroy', $rak->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group flex justify-end">
                                    {{-- <a href="{{ route('rak.edit', $rak->id) }}" class="btn btn-sm btn-warning "><i
                                            data-feather="edit"></i></a> --}}
                                    <button type="submit" class="btn btn-sm btn-error"><i
                                            data-feather="trash-2"></i></button>
                                </div>
                            </form>
                            <label class="btn btn-sm btn-warning modal-button" for="modal{{ $rak->id }}"><i
                                    data-feather="edit"></i></label>
                        </td>
                    </tr>
                    <input type="checkbox" id="modal{{ $rak->id }}" class="modal-toggle">
                    <div class="modal">
                        <div class="modal-box">
                            <p>{{ $rak->nama }}</p>
                            <div class="modal-action">
                                <button type="submit" class="btn btn-primary">Accept</button>
                                <label for="modal{{ $rak->id }}" class="btn">Close</label>
                            </div>
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
