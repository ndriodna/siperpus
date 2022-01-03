<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BukuRequest;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bukus = Buku::with('rak')->when(request()->q, function($bukus){
            $bukus = $bukus->where('judul','like', '%'. request()->q .'%');
        })->paginate(20);
        $raks = Rak::get();
        return view('dashboard.buku.index',compact('bukus','raks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.buku.create');
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

        // ubah request judul menjadi slug
        $data['slug'] =  Str::slug($request->judul, '-');

        // request file cover
        $cover = $request->file('cover');
        // simpan request cover kedalam folder public/covers dengan nama sesuai nama file
        $cover->storeAs('public/covers/', $cover->hashName());
        // tukar array cover dengan data request cover kemudian simpan ke db, hanya nama file saja tanpa path
        $data ['cover'] = $cover->hashName();

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
    public function edit(Buku $buku)
    {
        $raks = Rak::get();
        return view('dashboard.buku.edit',compact('buku','raks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(BukuRequest $request, Buku $buku)
    {
        $buku->update($request->all());
        return redirect(route('buku.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect(route('buku.index'));
    }
}
