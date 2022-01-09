<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Transaksi ') }}
    </h2>
  </x-slot>

  <div class="p-6 overflow-x-auto ">
    <div class="w-full pb-4">
      <div class="alert alert-info">
        <div class="flex-1">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          class="w-6 h-6 mx-2 stroke-current">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <label>Sistem otomatis akan menambahkan denda jika ada keterlambatan
          pengembalian buku,
          <label class="text-error">1 hari keterlambatan akan dikenakan biaya Rp. 1000 </label>
        </label>
      </div>
    </div>
  </div>
  <div class="w-full pb-4">
    <div class="relative">
      <form action="{{ route('transaksi.index') }}" method="get">
        <input type="text" name="q" placeholder="Search " class="input input-primary w-full"
        value="{{ request()->q }}">
        <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
          <i data-feather="search"></i>
        </button>
      </form>
    </div>
  </div>

  <div class="overflow-x-auto ">
    <table class="w-full table-compact">
      <thead>
        <tr>
          <th class="w-2/6">Judul</th>
          <th class="w-2/6">Petugas</th>
          <th class="w-3/6">Status</th>
          <th class="w-2/6">Tenggat</th>
          <th class="w-1/6"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-300">
        @foreach ($transaksis_member as $transaksi)
        <tr class="space-x-4">
          <td>
            <div class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 mask mask-squircle">
                  <img src="{{ $transaksi->buku->cover }}">
                </div>
              </div>
              <div class="font-bold">
                {{ $transaksi->buku->judul }}
              </div>
            </div>
          </td>
          <td class="text-center">
            <span>{{ $transaksi->petugas->nama ?? '-' }}</span>
          </td>
          <td>
            @if ($transaksi->status == 'menunggu verifikasi')
            <span class="badge badge-warning">{{ $transaksi->status }}</span>
            @elseif($transaksi->status == 'pinjam')
            <span class="badge badge-success">{{ $transaksi->status }}</span>
            @else
            <span class="badge badge-info">{{ $transaksi->status }}</span>
            @endif
          </td>
          <td class="text-center">{{ Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/M/Y') }}</td>
          <td colspan="2" class="flex justify-end align-center content-center">
            <label class="btn btn-sm btn-ghost btn-xs modal-button" for="modal{{ $transaksi->id }}">
              <span>Details</span>
            </label>
          </td>
        </tr>
        <input type="checkbox" id="modal{{ $transaksi->id }}" class="modal-toggle">
        <div class="modal overflow-y-auto grid lg:-mr-80 ">
          <div class="modal-box lg:w-full md:w-full w-full max-w-2xl">
            <div class="card">
              <h2 class="card-title text-center">Detail Transaksi </h2>
              <div class="flex justify-center">
                <img src="{{$transaksi->buku->cover}}" class="max-h-80 w-96 rounded">
              </div>
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
                  <div class="w-full"><span class="font-bold">Petugas</span></div>
                  <div class="text-lg w-full">{{$transaksi->petugas->nama ?? '-'}}</div>
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
                  <div class=" text-lg w-full">{{ Carbon\Carbon::create($transaksi->tgl_kembali)->lessThan(today()) ? Carbon\Carbon::create($transaksi->tgl_kembali)->lessThan(today()) : '0'}} Hari</div>
                </div>
                @endif
                <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                  <div class="w-full"><span class="font-bold">Status</span></div>
                  <div class=" text-lg w-full">
                   @if ($transaksi->status == 'menunggu verifikasi')
                   <span class="badge badge-lg badge-warning">{{ $transaksi->status }}</span>
                   @elseif($transaksi->status == 'pinjam')
                   <span class="badge badge-lg badge-success">{{ $transaksi->status }}</span>
                   @else
                   <span class="badge badge-lg badge-info">{{ $transaksi->status }}</span>
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
            @if ($transaksi->status == 'pinjam' && Carbon\Carbon::create($transaksi->tgl_kembali)->lessThanOrEqualTo(today()))
            <form action="{{route('transaksi.kembali',$transaksi->id)}}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-primary text-white"><i data-feather="check" class="mr-2"></i>Kembalikan</button>
            </form>
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
  {{ $transaksis_member->links() }}
</div>
</div>
</x-app-layout>
