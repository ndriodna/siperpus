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
        $countTransaksi = Transaksi::count();
        $countBuku = Buku::count();
        $countUser = User::count();
        $countPetugas = Petugas::count();
        $countMember = Member::count();


        // ambil data buku yg dimana created at >= tgl awal bulan sebelumnya sampai dengan tanggal akhir bulan sebelumnya, hitung jumlahnya
        $bulan_kemaren = Buku::where('created_at', '>=', Carbon::now()->startOfMonth()->subMonthNoOverflow())
                             ->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonthsNoOverflow())->count();

        // ambil data buku yg dimana created at >= tgl awal bulan ini sampai dengan tanggal akhir bulan ini, hitung jumlahnya
        $bulan_skrg = Buku::where('created_at', '>=', Carbon::now()->startOfMonth())
                          ->where('created_at', '<=', Carbon::now()->endOfMonth())->count();

        //---------------- rumus persentase---------------//
        // tambahan if klo bulan lalu kosong nda error
        $hasil_akhir = null;                 
        if ($bulan_kemaren > 0 && $bulan_skrg > 0) {
            $hasil_perbandingan = $bulan_skrg - $bulan_kemaren;

            $rumus = $hasil_perbandingan / $bulan_kemaren;

            $hasil_akhir = $rumus;
        }

        //----------------------------------------------//

         // ambil data buku yg dimana created at >= tgl awal bulan sebelumnya sampai dengan tanggal akhir bulan sebelumnya, hitung jumlahnya
        $bulan_kemaren_transaksi = Transaksi::where('created_at', '>=', Carbon::now()->startOfMonth()->subMonthNoOverflow())
                             ->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonthsNoOverflow())->count();

        // ambil data buku yg dimana created at >= tgl awal bulan ini sampai dengan tanggal akhir bulan ini, hitung jumlahnya
        $bulan_skrg_transaksi = Transaksi::where('created_at', '>=', Carbon::now()->startOfMonth())
                          ->where('created_at', '<=', Carbon::now()->endOfMonth())->count();

        //---------------- rumus persentase---------------//
        // tambahan if klo bulan lalu kosong nda error
        $hasil_akhir_transaksi = null;                 
        if ($bulan_kemaren_transaksi > 0 && $bulan_skrg_transaksi > 0) {
            $hasil_perbandingan = $bulan_skrg_transaksi - $bulan_kemaren_transaksi;

            $rumus = $hasil_perbandingan / $bulan_kemaren_transaksi;
            
            $hasil_akhir_transaksi = $rumus;
        }

        //----------------------------------------------//

        $transaksi = Transaksi::where('status','menunggu verifikasi')->get();

        $onlyAuthMember = null;
        $transakiAuthMember = null;
        $notifTerlambat = null;
        if (Auth::user()->level == 'member') {
            $onlyAuthMember = $transaksi->where('member_id', Auth::user()->member->id);
            $transakiAuthMember = Transaksi::where('member_id', Auth::user()->member->id)->get();
            $notifTerlambat = $transakiAuthMember->where('status','pinjam')->where('tgl_kembali','<' ,now());
        }
        return view('dashboard',compact('transaksi','onlyAuthMember','transakiAuthMember','countTransaksi','countBuku','countUser','countPetugas','countMember','notifTerlambat','hasil_akhir','hasil_akhir_transaksi'));
    }
}
