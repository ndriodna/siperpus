@component('mail::message')
    # Halo, {{ $transaksi->member->nama }}

    Buku dengan judul "{{$transaksi->buku->judul}}" 
    Yang anda pinjaman telah berhasil kami verifikasi, silahkan ambil buku diperpustakaan kampus PSDKU-Samarinda.

    pastikan buku dikembalikan pada tanggal {{ $transaksi->tgl_kembali }}.
    jika terlambat akan dikenakan denda Rp.1000/hari

    {{-- @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent --}}

    Salam
    PSDKU-Samarinda
@endcomponent
