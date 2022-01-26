<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kategoris = Kategori::Search('nama')->paginate(20);
      return view('dashboard.kategori.index',compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ],[
            'nama.required' => 'field nama tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0]);
        }

        Kategori::create([
            'nama' => $request->nama
        ]);
        return redirect(route('kategori.index'))->with('toast_success', 'Data Berhasil Ditambahkan!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string'
        ]);
        $kategori->update([
            'nama' => $request->nama
        ]);
        return redirect(route('kategori.index'))->with('toast_success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('toast_success', 'Data Berhasil dihapus!');
    }
}
