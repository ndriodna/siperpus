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
                    <th class="w-4/12">Judul</th>
                    <th class="w-2/12">Peminjam</th>
                    <th class="w-2/12">Petugas</th>
                    <th class="w-2/12">TGL Pinjam</th>
                    <th class="w-2/12">TGL Kembali</th>
                    <th class="w-2/12">Denda</th>
                    <th class="w-2/12">Status</th>
                    <th class="w-1/12"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300 space-x-6 space-y-4 " >
                @foreach ($transaksis as $transaksi)
                <tr class="">
                    <td>{{ $transaksi->buku->judul }}</td>
                    <td>{{ $transaksi->member->nama }}</td>
                    <td>{{ $transaksi->petugas->nama ?? '' }}</td>
                    <td>{{ $transaksi->tgl_pinjam }}</td>
                    <td>{{ $transaksi->tgl_kembali }}</td>
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
                    @if ($transaksi->status == 'menunggu verifikasi' && Auth::user()->level == 'petugas')
                    <td colspan="2" class="flex justify-end">
                        <label class="btn btn-sm btn-warning modal-button" for="modal{{ $transaksi->id }}">
                            <i data-feather="check"></i>
                        </label>
                        <input type="checkbox" id="modal{{ $transaksi->id }}" class="modal-toggle">
                        <div class="modal">
                            <div class="modal-box">
                                <p class="text-2xl">Verifikasi peminjaman sekarang ?</p>
                                <div class="modal-action">
                                    <form action="{{ route('transaksi.verifikasi', $transaksi->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </form>
                                    <label for="modal{{ $transaksi->id }}" class="btn">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-4">
        {{ $transaksis->links() }}
    </div>
</x-app-layout>
