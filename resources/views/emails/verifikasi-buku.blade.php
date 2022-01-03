@component('mail::message')
    # Halo, {{ $transaksi->member->nama }}

    Data diri peminjaman anda telah berhasil kami verifikasi,
    silahkan ambil buku diperpustakaan kampus PSDKU-Samarinda.

    pastikan buku dikembalikan {{ $transaksi->tgl_kembali }}.
    jika terlambat akan dikenakan denda Rp.1000/hari

    {{-- @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent --}}

    Salam
    PSDKU-Samarinda
@endcomponent
