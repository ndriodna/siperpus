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
                <h2 class="card-title text-center text-2xl">Detail Transaksi</h2>
                <div class="border-b-2 border-grey-600"></div>
                <div class="space-y-4">
                  <div class="text-center font-bold card-title my-4 px-12">
                    {{ $transaksi->buku->judul }}</div>
                    <div class="flex justify-center">
                      <span class="underline italic">{{ $transaksi->buku->pengarang }}</span>
                    </div>
                    <div class="flex justify-between px-20">
                      <div class="text-center font-semibold">Penerbit <br> <span
                        class="text-sm text-gray-400">{{ $transaksi->buku->penerbit ?? '-' }}</span>
                      </div>
                      <div class="text-center font-semibold">Tahun <br> <span
                        class="text-sm text-gray-400">{{ $transaksi->buku->tahun_terbit ?? '-' }}</span>
                      </div>
                    </div>
                    <div class="border-b-2 border-grey-600"></div>
                    <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                      <div class="w-full"><span class="font-bold">Peminjam</span></div>
                      <div class="text-lg w-full">{{ $transaksi->member->nama }}</div>
                    </div>
                    <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                      <div class="w-full"><span class="font-bold">Tgl pinjam</span></div>
                      <div class=" text-lg w-full">
                        {{ Carbon\Carbon::parse($transaksi->tgl_pinjam)->format('d/M/Y') }}</div>
                      </div>
                      @if(!$transaksi->tgl_kembali)
                      <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                        <div class="w-full"><span class="font-bold">Hari Peminjaman</span>
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
                        <div class="w-full"><span class="font-bold">Tgl
                        Pengembalian</span></div>
                        <div class=" text-lg w-full">
                          {{ $transaksi->tgl_pengembalian ? Carbon\Carbon::parse($transaksi->tgl_pengembalian)->format('d/M/Y') : '-' }}
                        </div>
                      </div>
                      <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                        <div class="w-full"><span class="font-bold">Terlambat</span>
                        </div>
                        <div class=" text-lg w-full">
                          {{ Carbon\Carbon::create($transaksi->tgl_kembali)->diffInDays($transaksi->tgl_pengembalian) }}
                        Hari</div>
                      </div>
                      @endif
                      @if ($transaksi->status == 'pinjam')
                      <div class="flex lg:justify-between md:justify-between mb-2 space-x-6 ">
                        <div class="w-full"><span class="font-bold">Terlambat</span>
                        </div>
                        <div class=" text-lg w-full">
                          {{ Carbon\Carbon::create($transaksi->tgl_kembali)->lte(Carbon\Carbon::now()) ? Carbon\Carbon::create($transaksi->tgl_kembali)->diffInDays(Carbon\Carbon::now()) : '0' }}
                        Hari</div>
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
                        <div class=" text-lg w-full">{!! $transaksi->denda ? '<span class="badge badge-lg badge-error"> Rp. ' . $transaksi->denda . '</span>' : '-' !!}</div>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="modal-action">
                    @if ($transaksi->status == 'menunggu verifikasi' && Auth::user()->level == 'petugas')
                    <form action="{{ route('transaksi.verifikasi', [$transaksi->id, $transaksi->hari]) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="btn btn-primary text-white"><i data-feather="check"
                        class="mr-2"></i> Verifikasi</button>
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
