<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use App\Mail\VerifikasiBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::with('member','petugas','buku')->paginate(10);

        if(auth::user()->level != 'member'){
            return view('dashboard.transaksi.index', compact('transaksis'));
        }else{
            $transaksis_member = Transaksi::with('member','petugas','buku')
                                ->where('member_id', auth::user()->member->id)->paginate(10);
            if($transaksis_member->count() <= 0){
                return view('dashboard.transaksi.hero', compact('transaksis_member'));
            }else{
                return view('dashboard.transaksi.member', compact('transaksis_member'));
            }
        }
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
        $length = 10;
        $random = '';

        for($i = 0; $i < $length; $i++){
            $random .= rand(0,1) ? rand(0,9) : chr(rand(ord('a'), ord('z')));
        }

        $invoice = 'UM-'.Str::upper($random);

        Transaksi::create([
            'invoice' => $invoice,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'buku_id' => $request->buku_id,
            'member_id' => Auth::user()->member->id,
            'status' => 'menunggu verifikasi',
        ]);


        return redirect(route('transaksi.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function pinjam(Request $request, $slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        return view('dashboard.transaksi.create', compact('buku'));
    }

    public function verifikasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'Pinjam',
            'petugas_id' => Auth::user()->petugas->id,
        ]);

        mail::to($transaksi->member->user->email)->send(new VerifikasiBuku($transaksi));

        $transaksi->buku->where('id', $transaksi->buku_id)->update([
            'stok' => $transaksi->buku->stok - 1
        ]);

        return back();
    }

    public function kembali($id)
    {
        $transaksi = Transaksi::with('member','petugas','buku')
        ->where('member_id', auth::user()->member->id)->findOrFail($id);

        $transaksi->update([
            'status' => 'kembali'
        ]);

        $transaksi->buku->where('id', $transaksi->buku_id)->update([
            'stok' => $transaksi->buku->stok ++
        ]);

        return back()->with('toast_success', 'Buku Berhasil Dikembalikan!');
    }

}
