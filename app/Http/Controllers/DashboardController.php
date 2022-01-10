<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Member;
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
        if (Auth::user()->level == 'member') {
            $onlyAuthMember = $transaksi->where('member_id', Auth::user()->member->id);
            $transakiAuthMember = Transaksi::where('member_id', Auth::user()->member->id)->count();
        }
        return view('dashboard',compact('transaksi','onlyAuthMember','transakiAuthMember','countTransaksi','countBuku','countUser','countPetugas','countMember'));
    }
}
