<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BukuRequest;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $bukus = Buku::with('rak')->Search()->paginate(20);
        $raks = Rak::get();
        return view('dashboard.buku.index',compact('bukus','raks'));
=======
        $bukus = Buku::with('kategori')->when(request()->q, function($search){
            $search->where(request()->by ?? 'judul','like','%'.request()->q.'%');
        })->paginate(20);
        $kategoris = Kategori::get();
        return view('dashboard.buku.index',compact('bukus','kategoris'));
>>>>>>> bd39737e7a8517d78cc1057563059a72877f3925
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuRequest $request)
    {
        // tampung semua request kedalam variabel
        $data = $request->all();

        // request file cover
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
        // simpan request cover kedalam folder public/covers dengan nama sesuai nama file
            $cover->storeAs('public/covers/', $cover->hashName());
        // tukar array cover dengan data request cover kemudian simpan ke db, hanya nama file saja tanpa path
            $data ['cover'] = $cover->hashName();
        }
        Buku::create($data);

        return redirect(route('buku.index'))->with('toast_success','Data Buku Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return view('dashboard.buku.show',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function edit(Buku $buku)
    {
        $raks = Rak::get();
        return view('dashboard.buku.edit',compact('buku','raks'));
    }
=======
            public function edit(Buku $buku)
            {
                $kategoris = Kategori::get();
                return view('dashboard.buku.edit',compact('buku','kategoris'));
            }
>>>>>>> bd39737e7a8517d78cc1057563059a72877f3925

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(BukuRequest $request, Buku $buku)
    {
        $data = $request->all();

        $data['slug'] =  Str::slug($request->judul, '-');

        if ($request->hasFile('cover')) {
            $cover_old = $data['cover'];
            Storage::disk('local')->delete('public/covers/'.basename($cover_old));

            $cover = $request->file('cover');
            $cover->storeAs('public/covers/', $cover->hashName());
            $data ['cover'] = $cover->hashName();
            $buku->update($data);
        }else{
            $buku->update($data);
        }
        return redirect(route('buku.index'))->with('toast_success','Data Buku Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        if ($buku->cover) {
            Storage::disk('local')->delete('public/covers/'.basename($buku->cover));
            $buku->delete();
        }else{
            $buku->delete();
        }
        return redirect(route('buku.index'))->with('toast_success','Berhasil Menghapus Buku!');
    }
}
