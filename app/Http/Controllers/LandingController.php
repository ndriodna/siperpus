<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\Petugas;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bukus = Buku::inRandomOrder()->where('stok', '!=', 0)->when(request()->search, function($bukus){
            $bukus = $bukus->where('judul','like', '%' . request()->search.'%');
        })->paginate(8);
        return view('landing.index',compact('bukus'));
    }

    public function dashboard()
    {
        $transaksi = Transaksi::where('status','menunggu verifikasi')->get();

        $onlyAuthMember = null;
        if (Auth::user()->level == 'member') {
            $onlyAuthMember = $transaksi->where('member_id', Auth::user()->member->id);
        }
        return view('dashboard',compact('transaksi','onlyAuthMember'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        return view('landing.show',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
