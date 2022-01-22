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
  <a href="{{route('landing.index')}}" class="btn btn-outline btn-primary"><i data-feather="arrow-left" class="mr-2"></i>Pinjam Buku Lagi</a>
  <div class="w-full mx-auto py-4">
    <form action="{{ route('transaksi.index') }}" method="get">
      <div class="relative inset-y-0 flex items-center">
        <select name="q" class="select select-primary rounded-r-none w-1/2 ">
          <option disabled selected>{{request()->q ?? 'Status'}}</option>
          <option value="menunggu verifikasi">Menunggu Verifikasi</option>
          <option value="pinjam">Pinjam</option>
          <option value="kembali">Kembali</option>
        </select>
        <button class="btn btn-primary rounded-l-none">
          <i data-feather="search"></i>
        </button>
      </div>
    </form>
  </div>

  <div class="overflow-x-auto ">
    <table class="w-full table-compact">
      <thead>
        <tr>
          <th class="w-2/6">Judul</th>
          <th class="w-2/6">Petugas</th>
          <th class="w-3/6">Status</th>
          <th class="w-3/6">Pembayaran</th>
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
          @if($transaksi->status == 'kembali')
          <td>
            @if($transaksi->status_denda == 'lunas')
            <span class="badge badge-success">{{ $transaksi->status_denda }}</span>
            @else
            <span class="badge badge-warning">{{ $transaksi->status_denda }}</span>
            @endif
          </td>
          @else
          <td>-</td>
          @endif
          <td class="text-center">{{ Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/M/Y') }}</td>
          <td colspan="2" class="flex justify-end align-center content-center">
            <label class="btn btn-sm btn-ghost btn-xs modal-button" for="modal{{ $transaksi->id }}">
              <span>Details</span>
            </label>
          </td>
        </tr>
        <input type="checkbox" id="modal{{ $transaksi->id }}" class="modal-toggle">
        <div class="modal overflow-y-auto grid sm:mx-auto md:-mr-80 ">
          <div class="modal-box w-screen">
            <div class="card">
              @include('dashboard.transaksi.details')
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
