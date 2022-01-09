<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Transaksi ') }}
    </h2>
  </x-slot>

  <div class="lg:w-1/2 w-full mx-auto py-4">
    <div class="relative">
      <form action="{{ route('transaksi.index') }}" method="get">
        <input type="text" name="q" placeholder="Search" class="input input-bordered input-primary w-full"
        value="{{ request()->q }}">
        <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
          <i data-feather="search"></i>
        </button>
      </form>
    </div>
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
          <th class="w-1/6"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-300 space-x-6 space-y-4 " >
        @foreach ($transaksis as $transaksi)
        <tr class="">
          <td>{{ $transaksi->buku->judul }}</td>
          <td class="text-center">{{ $transaksi->member->nama }}</td>
          <td class="text-center">{{ $transaksi->petugas->nama ?? '' }}</td>
          <td class="text-center">{{ Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/M/Y') }}</td>
          <td>
            @if ($transaksi->status == 'menunggu verifikasi')
            <span class="badge badge-warning">{{ $transaksi->status }}</span>
            @elseif($transaksi->status == 'pinjam')
            <span class="badge badge-success">{{ $transaksi->status }}</span>
            @else
            <span class="badge badge-info">{{ $transaksi->status }}</span>
            @endif
          </td>
          <td colspan="2" class="flex justify-end">
            <label class="btn btn-sm btn-ghost modal-button" for="modal{{ $transaksi->id }}">
              Details
            </label>
          </td>
        </tr>
        <input type="checkbox" id="modal{{ $transaksi->id }}" class="modal-toggle">
        <div class="modal overflow-y-auto sm:mx-auto md:-mr-80">
          <div class="modal-box w-screen">
            <div class="card">
              <h2 class="card-title text-center text-2xl">Detail Transaksi</h2>
              <div class="border-b-2 border-grey-600"></div>
              <div class="space-y-4">
                <div class="text-center font-bold card-title my-4 px-12">{{$transaksi->buku->judul}}</div>
                <div class="flex justify-center">
                  <span class="underline italic">{{$transaksi->buku->pengarang}}</span>
                </div>
                <div class="flex justify-between px-20">
                  <div class="text-center font-semibold">Penerbit <br> <span class="text-sm text-gray-400">{{$transaksi->buku->penerbit ?? '-'}}</span></div>
                  <div class="text-center font-semibold">Tahun <br> <span class="text-sm text-gray-400">{{$transaksi->buku->tahun_terbit ?? '-'}}</span></div>
                </div>
                <div class="border-b-2 border-grey-600"></div>
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Peminjam</span></div>
                  <div class="text-lg w-full">{{$transaksi->member->nama}}</div>
                </div>
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Tgl pinjam</span></div>
                  <div class=" text-lg w-full">{{ Carbon\Carbon::parse($transaksi->tgl_pinjam)->format('d/M/Y') }}</div>
                </div>
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Tgl Kembali</span></div>
                  <div class=" text-lg w-full">{{ Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/M/Y') }}</div>
                </div>
                @if ($transaksi->status == 'kembali')
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Tgl Pengembalian</span></div>
                  <div class=" text-lg w-full">{{ $transaksi->tgl_pengembalian ? Carbon\Carbon::parse($transaksi->tgl_pengembalian)->format('d/M/Y') : '-' }}</div>
                </div>
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Terlambat</span></div>
                  <div class=" text-lg w-full">{{ Carbon\Carbon::create($transaksi->tgl_kembali)->diffInDays($transaksi->tgl_pengembalian) }} Hari</div>
                </div>
                @endif
                @if ($transaksi->status == 'pinjam')
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Terlambat</span></div>
                  <div class=" text-lg w-full">{{ Carbon\Carbon::create($transaksi->tgl_kembali)->diffInDays(today()) ?? '0'}} Hari</div>
                </div>
                @endif
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Status</span></div>
                  <div class=" text-lg w-full">
                    @if ($transaksi->status == 'menunggu verifikasi')
                    <span class="badge badge-warning">{{ $transaksi->status }}</span>
                    @elseif($transaksi->status == 'pinjam')
                    <span class="badge badge-success">{{ $transaksi->status }}</span>
                    @else
                    <span class="badge badge-info">{{ $transaksi->status }}</span>
                    @endif
                  </div>
                </div>
                @if ($transaksi->status == 'kembali')
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Denda</span></div>
                  <div class=" text-lg w-full">{!! $transaksi->denda ? '<span class="badge badge-lg badge-error"> Rp. ' .$transaksi->denda  .'</span>' : '-' !!}</div>
                </div>
                @endif
              </div>
            </div>
            <div class="modal-action">
              @if ($transaksi->status == 'menunggu verifikasi' && Auth::user()->level == 'petugas')
              <form action="{{ route('transaksi.verifikasi', $transaksi->id) }}"
                method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary text-white"><i data-feather="check" class="mr-2"></i> Verifikasi</button>
              </form>
              @endif
              <label for="modal{{ $transaksi->id }}" class="btn">
                Kembali
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
