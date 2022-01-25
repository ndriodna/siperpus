<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $raks = Rak::Search('nama')->paginate(20);
      return view('dashboard.rak.index',compact('raks'));
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

        Rak::create([
            'nama' => $request->nama
        ]);
        return redirect(route('rak.index'))->with('toast_success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function show(Rak $rak)
    {
        $rak->with('buku');
        return view('dashboard.rak.show',compact('rak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rak $rak)
    {
        $request->validate([
            'nama' => 'required|string'
        ]);
        $rak->update([
            'nama' => $request->nama
        ]);
        return redirect(route('rak.index'))->with('toast_success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rak $rak)
    {
        $rak->delete();
        return back()->with('toast_success', 'Data Berhasil dihapus!');
    }
}
