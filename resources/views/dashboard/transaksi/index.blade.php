<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Transaksi ') }}
    </h2>
  </x-slot>

  <div class="w-full mx-auto py-4">
    <form action="{{ route('transaksi.index') }}" method="get">
      <div class="relative inset-y-0 flex items-center block">
        <input type="text" name="q" placeholder="Cari" class="input input-primary w-full rounded-r-none"
        value="{{ request()->q }}">
        <select name="by" class="select select-primary rounded-l-none rounded-r-none">
          <option disabled selected>Cari berdasarkan</option>
          <option value="status">Status</option>
          <option value="nama">Petugas</option>
          <option value="judul">Judul</option>
          <option value="nama">Peminjam</option>
        </select>
        <button class="btn btn-primary rounded-l-none">
          <i data-feather="search"></i>
        </button>
      </div>
    </form>
  </div>
  <div class="p-6 overflow-x-auto w-full">
    <table class="w-full table-compact">
      <thead>
        <tr>
          <th class="w-2/6">Judul</th>
          <th class="w-1/6">Peminjam</th>
          <th class="w-1/6">Petugas</th>
          <th class="w-1/6">TGL Kembali</th>
          <th class="w-1/6">Status</th>
          <th class="w-1/6">Pembayaran</th>
          <th class="w-1/6"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-300 space-x-6 space-y-4 ">
        @foreach ($transaksis as $transaksi)
        <tr class="">
          <td>{{ $transaksi->buku->judul }}</td>
          <td class="text-center">{{ $transaksi->member->nama }}</td>
          <td class="text-center">{{ $transaksi->petugas->nama ?? '' }}</td>
          <td class="text-center">
            {{ $transaksi->tgl_kembali ? Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/M/Y') : '-' }}</td>
            <td>
              @if ($transaksi->status == 'menunggu verifikasi')
              <span class="badge badge-warning">{{ $transaksi->status }}</span>
              @elseif($transaksi->status == 'pinjam')
              <span class="badge badge-success">{{ $transaksi->status }}</span>
              @else
              <span class="badge badge-info">{{ $transaksi->status }}</span>
              @endif
            </td>
            @if($transaksi->status == 'kembali')
            <td>
              @if($transaksi->status_denda == 'lunas')
              <span class="badge badge-info">{{ $transaksi->status_denda }}</span>
              @else
              <span class="badge badge-warning">{{ $transaksi->status_denda }}</span>
              @endif
            </td>
            @else
            <td>-</td>
            @endif
            <td colspan="2" class="flex justify-end">
              <label class="btn btn-sm btn-ghost modal-button" for="modal{{ $transaksi->id }}">
                Details
              </label>
            </td>
          </tr>
          <input type="checkbox" id="modal{{ $transaksi->id }}" class="modal-toggle">
          <div class="modal overflow-y-auto grid sm:mx-auto md:-mr-80">
            <div class="modal-box w-screen">
              <div class="card">
                @include('dashboard.transaksi.details')
                <div class="modal-action">
                  @if(Auth::user()->level == 'petugas')
                  @if ($transaksi->status == 'menunggu verifikasi')
                  <form action="{{ route('transaksi.verifikasi', [$transaksi->id, $transaksi->hari]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary text-white"><i data-feather="check"
                      class="mr-2"></i> Verifikasi</button>
                    </form>
                    @endif
                    @if ($transaksi->status == 'kembali' && $transaksi->status_denda == 'belum lunas' && $transaksi->denda > 0)
                    <form action="{{route('transaksi.lunas',$transaksi->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="btn btn-primary text-white"><i data-feather="check"
                        class="mr-2"></i>  Pembayararan Lunas</button>
                      </form>
                      @endif
                      @endif
                      <label for="modal{{ $transaksi->id }}" class="btn">
                        Tutup
                      </label>
                    </div>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="py-4">
            {{ $transaksis->links() }}
          </div>
        </x-app-layout>
