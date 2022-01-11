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

        $transaksi = Transaksi::where('status','menunggu verifikasi')->get();

        $onlyAuthMember = null;
        $transakiAuthMember = null;
        $notifTerlambat = null;
        if (Auth::user()->level == 'member') {
            $onlyAuthMember = $transaksi->where('member_id', Auth::user()->member->id);
            $transakiAuthMember = Transaksi::where('member_id', Auth::user()->member->id)->get();
            $notifTerlambat = $transakiAuthMember->where('status','pinjam')->where('tgl_kembali','<' ,now());
            // dd(Carbon::today());
        }
        return view('dashboard',compact('transaksi','onlyAuthMember','transakiAuthMember','countTransaksi','countBuku','countUser','countPetugas','countMember','notifTerlambat'));
    }
}
