<h2 class="card-title text-center text-2xl">Detail Transaksi </h2>
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

  <div class="text-center font-bold card-title px-12">Status</div>
  <div class="flex justify-center">
    <span class="font-semibold capitalize ">
      <div class=" text-lg w-full">
        @if ($transaksi->status == 'menunggu verifikasi')
        <span class="badge badge-lg badge-warning">{{ $transaksi->status }}</span>
        @elseif($transaksi->status == 'pinjam')
        <span class="badge badge-lg badge-success">{{ $transaksi->status }}</span>
        @else
        <span class="badge badge-lg badge-info">{{ $transaksi->status }}</span>
        @endif
      </div>
    </span>
  </div>
  @if($transaksi->status == 'kembali')
  <div class="flex justify-between px-20">
    <div class="text-center font-semibold">Denda <br> <span class="">
      @if($transaksi->status_denda == 'lunas')
      <div class=" text-lg w-full line-through"><span class="badge badge-lg badge-info "> Rp. {{ $transaksi->denda }}</span></div>
      @else
      <div class=" text-lg w-full">{!! $transaksi->denda ? '<span class="badge badge-lg badge-error"> Rp. ' . $transaksi->denda . '</span>' : '-' !!}</div>
      @endif
    </span>
  </div>
  <div class="text-center font-semibold">Pembayaran <br> <span
    class="">
    <div class=" text-lg w-full">
      @if($transaksi->denda == true)
      @if($transaksi->status_denda == 'lunas')
      <span class="badge badge-lg badge-info">{{ $transaksi->status_denda }}</span>
      @else
      <span class="badge badge-lg badge-warning">{{ $transaksi->status_denda }}</span>
      @endif
      @else
      -
      @endif
    </div>
  </span>
</div>
</div>
@endif
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
@if(!$transaksi->tgl_kembali)
<div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
  <div class="w-full"><span class="font-bold">Lama Peminjaman</span>
  </div>
  <div class=" text-lg w-full">{{ $transaksi->hari}} Hari</div>
</div>
@else
<div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
  <div class="w-full"><span class="font-bold">Tgl Kembali</span>
  </div>
  <div class=" text-lg w-full">
    {{ Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/M/Y')}}
  </div>
</div>
@endif
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
  <div class=" text-lg w-full">
    {{ Carbon\Carbon::create($transaksi->tgl_kembali)->lte(Carbon\Carbon::now()) ? Carbon\Carbon::create($transaksi->tgl_kembali)->diffInDays(Carbon\Carbon::now()) : '0' }}
  Hari</div>
</div>
@endif

</div>
</div>