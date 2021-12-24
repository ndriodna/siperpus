<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Transaksi') }}
    </h2>
  </x-slot>
  <div class="p-6">
    <div class="w-1/4 pb-4">
      <div class="relative">
        <form action="{{ route('transaksi.index') }}" method="get">
          <input type="text" name="q" placeholder="Search" class="input input-primary w-full"
          value="{{ request()->q }}">
          <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
            <i data-feather="search"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="overflow-x-auto ">
      <table class="table-fixed w-full table-compact">
        <thead>
          <tr>
            <th class="w-10/12">Judul</th>
            <th class="w-1/2">Petugas</th>
            <th class="w-1/2">Member</th>
            <th class="w-1/2">Tgl Pinjam</th>
            <th class="w-1/2">Tgl Kembali</th>
            <th class="w-1/2">Denda</th>
            <th class="w-1/4">Status</th>
            <th class="w-1/2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaksis as $transaksi)
          <tr>
            <td>{{ $transaksi->buku->judul }}</td>
            <td>{{ $transaksi->petugas->nama }}</td>
            <td>{{ $transaksi->member->nama }}</td>
            <td>{{ $transaksi->tgl_pinjam }}</td>
            <td>{{ $transaksi->tgl_kembali }}</td>
            <td>{{ $transaksi->denda }}</td>
            <td>{{ $transaksi->status }}</td>
            <td colspan="2">
              <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning "><i
                  data-feather="edit"></i></a>
                  <button type="submit" class="btn btn-sm btn-error"><i
                    data-feather="trash-2"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="py-4">
          {{ $transaksis->links() }}
        </div>
      </div>



    </x-app-layout>
