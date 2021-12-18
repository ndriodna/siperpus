<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $raks = Rak::get();
      return view('dashboard.rak.index',compact('raks'));
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
      $request->validate([
        'nama' => 'required|string'
    ]);
      Rak::create([
        'nama' => $request->nama
    ]);
      return redirect(route('rak.index'));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function edit(Rak $rak)
    {
        return view('dashboard.rak.edit',compact('rak'));
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
        return redirect(route('rak.index'));
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
        return redirect('dashboard.rak.index');
    }
}
