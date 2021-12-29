<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Transaksi ') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-x-auto ">
        <div class="w-1/4 pb-4">
            <div class="relative">
                <form action="{{ route('user.index') }}" method="get">
                    <input type="text" name="q" placeholder="Search" class="input input-primary w-full"
                        value="{{ request()->q }}">
                    <button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
                        <i data-feather="search"></i>
                    </button>
                </form>
            </div>
        </div>
        <table class="table table-fixed w-full table-compact">
            <thead>
                <tr>
                    <th class="w-1/2">Judul</th>
                    <th class="w-1/2">Peminjam</th>
                    <th class="w-1/2">TGL Pinjam</th>
                    <th class="w-1/2">TGL Kembali</th>
                    <th class="w-1/2">Denda</th>
                    <th class="w-1/2">Status</th>
                    <th class="w-1/2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td>{{ $transaksi->buku->judul }}</td>
                        <td>{{ $transaksi->member->nama }}</td>
                        <td>{{ $transaksi->tgl_pinjam }}</td>
                        <td>{{ $transaksi->tgl_kembali }}</td>
                        <td>{{ $transaksi->denda ?? 'Rp. 0' }}</td>
                        <td><span class="badge badge-warning">{{ $transaksi->status }}</span></td>
                        @if ($transaksi->status == 'menunggu verifikasi')
                            <td colspan="2" class="flex justify-end">
                                <form action="{{ route('transaksi.verifikasi', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i data-feather="check"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-4">
            {{ $transaksis->links() }}
        </div>
    </div>
</x-app-layout>
