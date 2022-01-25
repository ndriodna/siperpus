<?php

namespace App\Http\Controllers;

use App\Models\Buku;
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
        $bukus = Buku::latest()->where('stok', '!=', 0)
                      ->SearchBy(request()->by ?? 'judul')->paginate(8);
        return view('landing.index',compact('bukus'));
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
}
