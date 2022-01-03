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
                <form action="{{ route('user.index') }}" method="get">
                    <input type="text" name="q" placeholder="Search " class="input input-primary w-full"
                        value="{{ request()->q }}">
                    <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
                        <i data-feather="search"></i>
                    </button>
                </form>
            </div>
        </div>
        {{-- <div class="inline-flex w-full grid grid-cols-2 gap-2">
            <div class="pr-2">
                <div class=" form-control">
                    <input type="date" name="tgl_kembali" class="input input-primary">
                </div>
            </div>
            <div class="w-full pb-4">
                <div class=" form-control">
                    <input type="date" name="tgl_kembali" class="input input-primary">
                </div>
            </div>
        </div> --}}
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Peminjam</th>
                    <th>TGL Pinjam</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis_member as $transaksi)
                    <tr>
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
                        <td>
                            <span>{{ $transaksi->member->nama }}</span>
                            <br>
                            <span class="text-sm font-bold">{{ $transaksi->member->nim }}</span>
                        </td>
                        <td>{{ Carbon\Carbon::parse($transaksi->tgl_pinjam)->format('d/M/Y') }}</td>
                        <th>
                            <button class="btn btn-ghost btn-xs">details</button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <table class="table table-fixed w-full table-compact">
            <thead>
                <tr>
                    <th class="w-full">Judul</th>
                    <th class="w-1/2">Peminjam</th>
                    <th class="w-1/2">TGL Pinjam</th>
                    <th class="w-1/2">TGL Kembali</th>
                    <th class="w-3/4">TGL Pengembalian</th>
                    <th class="w-1/2">Denda</th>
                    <th class="w-1/2">Status</th>
                    <th class="w-1/2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis_member as $transaksi)
                    <tr>
                        <td>{{ $transaksi->buku->judul }}</td>
                        <td>{{ $transaksi->member->nama }}</td>
                        <td>{{ carbon\carbon::parse($transaksi->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ carbon\carbon::parse($transaksi->tgl_kembali)->format('d/m/Y') }}</td>
                        @if ($transaksi->status == 'kembali')
                            <td>
                                {{ carbon\carbon::parse($transaksi->tgl_pengembalian)->format('d/m/Y') }}
                            </td>
                        @else
                            <td></td>
                        @endif
                        @if ($transaksi->status == 'kembali')
                            <td>Rp. {{ $transaksi->denda }}</td>
                        @else
                            <td></td>
                        @endif
                        <td>
                            @if ($transaksi->status == 'menunggu verifikasi')
                                <span class="badge badge-warning">{{ $transaksi->status }}</span>
                            @elseif($transaksi->status == 'pinjam')
                                <span class="badge badge-success">{{ $transaksi->status }}</span>
                            @else
                                <span class="badge badge-info">{{ $transaksi->status }}</span>
                            @endif
                        </td>
                        @if ($transaksi->status == 'pinjam')
                            <td class="flex justify-end">
                                <form action="{{ route('transaksi.kembali', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary text-white">
                                        <i data-feather="check"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <div class="py-4">
            {{ $transaksis_member->links() }}
        </div>
    </div>
</x-app-layout>
