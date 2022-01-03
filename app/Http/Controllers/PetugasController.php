<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use App\Http\Requests\PetugasRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambil data user dengan member dimana levelnya != member, pecah 10 data per halaman
        $users = User::with('member','petugas')->where('level', '!=', 'admin')->paginate(10);

        // lempar variabel ke view
        return view('dashboard.petugas.index',compact('users'));
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
    public function store(PetugasRequest $request)
    {
        Petugas::create($request->all());
        return redirect(route('petugas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $petugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petugas)
    {
        //
    }

    public function role($id)
    {
        // cari data user berdasarakan id
        $user = User::findOrFail($id);

        // update data user ke level petugas berdasarkan id
        $user->update([
            'level' => 'petugas'
        ]);

        // buat data petugas berdasarakan id user
        Petugas::create([
            'user_id' => $id
        ]);

        // hapus data member berdasarkan id
        $user->member->where('user_id', $id)->delete();

        // kembali kehalaman sebelumnya dengan toast success
        return back()->with('toast_success', 'Berhasil Melakukan Update Level Petugas');
    }
}
