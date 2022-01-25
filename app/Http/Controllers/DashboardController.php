<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Member;
use App\Models\Petugas;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // hitung jumlah transaksi
        $countTransaksi = Transaksi::count();

        // hitung jumlah buku
        $countBuku = Buku::count();

        // hitung jumlah user
        $countUser = User::count();

        // hitung jumlah petugas
        $countPetugas = Petugas::count();

        // hitung jumlah member
        $countMember = Member::count();

        // hitung jumlah buku bulan kemaren
        $bukuBulanKemaren = Buku::LastMonth()->count();

        // hitung jumlah buku bulan ini
        $bukuBulanIni = Buku::ThisMonth()->count();

        // rumus presentase buku
        $hasilAkhirBuku = null;
        if ($bukuBulanKemaren > 0 && $bukuBulanIni > 0) {
            $hasilPerbandingan = $bukuBulanIni - $bukuBulanKemaren;

            $rumus = $hasilPerbandingan / $bukuBulanKemaren;

            $hasilAkhirBuku = $rumus * 100;
        }

        // hitung jumlah transaksi bulan kemaren
        $transaksiBulanKemaren = Transaksi::LastMonth()->count();

        // hitung jumlah transaksi bulan ini
        $transaksiBulanIni = Transaksi::ThisMonth()->count();

        // rumus presentase transaksi
        $hasilAkhirTransaksi = null;
        if ($transaksiBulanKemaren > 0 && $transaksiBulanIni > 0) {
            $hasilPerbandingan = $transaksiBulanIni - $transaksiBulanKemaren;

            $rumus = $hasilPerbandingan / $transaksiBulanKemaren;

            $hasilAkhirTransaksi = $rumus * 100;
        }

        // ambil data transaski dengan status menunggu verifikasi
        $transaksi = Transaksi::FilterStatus('menunggu verifikasi')->get();

        // variabel
        $onlyAuthMember = null;
        $transakiAuthMember = null;
        $notifTerlambat = null;
<<<<<<< HEAD

        // check level user
=======
        $notifDenda = null;
>>>>>>> bd39737e7a8517d78cc1057563059a72877f3925
        if (Auth::user()->level == 'member') {
            // ambil data transaksi user yang sedang login dengan status menunggu verifikasi
            $onlyAuthMember = $transaksi->where('member_id', Auth::user()->member->id);

            // ambil data transaski user yang sedang login
            $transakiAuthMember = Transaksi::where('member_id', Auth::user()->member->id)->get();

            // ambil data transaksi user yang sedang login degan status pinjam dan tanggal kembali < sekarang
            $notifTerlambat = $transakiAuthMember->where('status','pinjam')->where('tgl_kembali','<' ,now());
            $notifDenda = $transakiAuthMember->where('status_denda','belum lunas')->count();
        }
<<<<<<< HEAD
        return view('dashboard',compact('transaksi','onlyAuthMember','transakiAuthMember','countTransaksi','countBuku','countUser','countPetugas','countMember','notifTerlambat','hasilAkhirBuku','hasilAkhirTransaksi'));
=======
        return view('dashboard',compact('transaksi','onlyAuthMember','transakiAuthMember','countTransaksi','countBuku','countUser','countPetugas','countMember','notifTerlambat','notifDenda','hasil_akhir','hasil_akhir_transaksi'));
>>>>>>> bd39737e7a8517d78cc1057563059a72877f3925
    }
}
