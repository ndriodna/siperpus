<p align="center"><a href="http://perpusmulia.herokuapp.com" target="_blank"><img src="public/logo-1.png"></a></p>


- [Tentang Perpus Mulia](#tentang-perpus-mulia)
- [Fitur](#fitur)
- [Install](#install)
- [Demo](#demo)


## Tentang Perpus Mulia

Perpus Mulia  adalah aplikasi web peminjaman buku perpustakaan PSDKU universitas mulia samarinda aplikasi ini dibuat untuk menyelesaikan tugas akhir matakuliah **PEMROGRAMAN BERORIENTASI OBYEK** 

## Fitur 
- Terdapat 3 role yaitu : admin, petugas, dan member
- Verifikasi peminjaman (Petugas)
- Verifikasi Pembayaran (Petugas)
- Mengelola user (Admin)
- Mengelola profile masing-masing
- CRUD
- Filter Pencarian
- Member dapat meminjam buku perpustakan secara online
- Pemberitahuan berupa email ketika peminjaman buku telah diverifikasi petugas
- Dashboard yang menarik menampilkan notifikasi 
- Notifikasi admin dan petugas
    - Notifikasi jumlah peminjaman yang belum terverifikasi
- Notifikasi member 
    - Notifikasi peminjaman yang belum terverifiaski 
    - Notifikasi peminjaman terlambat
    - Notifikasi denda peminjaman yang belum lunas
- Detail transaksi
- Responsive
## Install

> Pastikan git cli sudah terinstall
```
1. git clone https://github.com/ndriodna/siperpus.git
2. copy .env.example .env
3. composer install
4. php artisan key:generate
5. Atur nama database dan username pada file .env
6. php artisan migrate --seed
```

## Demo
> Untuk demo dapat kunjungi link dibawah <br>
http://perpusmulia.herokuapp.com

- Admin
    - ```email: admin@mail.com``` <br> ```password: superadmin``` 

- Petugas
    - ```email: petugas1@mail.com``` <br> ```password: petugas123```
