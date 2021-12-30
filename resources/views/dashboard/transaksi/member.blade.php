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
                    <label>Sistem otomatis akan menambahkan durasi peminjaman selama 7 hari</label>
                </div>
            </div>
        </div>
        <div class="w-1/2 pb-4">
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
                    <th class="w-1/2">Durasi</th>
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
                        <td>{{ carbon\carbon::parse($transaksi->tgl_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ carbon\carbon::parse($transaksi->tgl_kembali)->format('d-m-Y') }}</td>
                        @if ($transaksi->status == 'pinjam')
                            <td>
                                <?php
                                $waktu_pinjam = strtotime($transaksi->tgl_kembali . '+7 days');
                                $waktu_skrg = strtotime(date('d-m-Y'));
                                $batas_waktu = ($waktu_pinjam - $waktu_skrg) / 86400;
                                ?>
                                @if ($batas_waktu < 0)
                                    {{ $batas_waktu }} Hari
                                @else
                                    {{ $batas_waktu }} Hari
                                @endif
                            </td>
                            <td>
                                @if ($batas_waktu < 0)
                                    <?php $denda = abs($batas_waktu) * 1000; ?>
                                    Rp. {{ $denda }}
                                @else
                                    Rp. 0
                                @endif
                            </td>
                        @else
                        <td>-</td>
                        <td>-</td>
                        @endif
                        <td><span class="badge badge-warning">{{ $transaksi->status }}</span></td>
                        @if ($transaksi->status == 'pinjam')
                            <td class="flex justify-end">
                                <form action="{{ route('transaksi.kembali', $transaksi->id) }}" method="POST">
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
            {{ $transaksis_member->links() }}
        </div>
    </div>
</x-app-layout>
