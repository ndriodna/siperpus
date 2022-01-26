<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $currentUser = Auth::user();
       return view('dashboard.profile.index',compact('currentUser'));
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // cek user yang sedang login apakah levelnya tidak sama dengan 'member'
        if(auth::user()->level != 'member'){
            // validasi petugas
            $request->validate([
                'nama' => 'nullable|string',
                'jk' => 'nullable|in:L,P',
                'jabatan' => 'nullable|string',
                'telp' => 'nullable|string',
                'alamat' => 'nullable|string',
            ]);
            // check tabel petugas 'user_id' sudah ada data atau belum
            Petugas::updateOrCreate([
                'user_id' => auth::id(),
            ],
            // jika sudah ada data lakukan update, jika belum tambah data baru beserta 'user_id'
            [
                'nama' => $request->nama,
                'jk' => $request->jk,
                'jabatan' => $request->jabatan,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'created_at' => now(),
            ]
        );
        }else{
            // validasi member
            $request->validate([
                'nama' => 'nullable|string',
                'nim' => 'nullable|integer',
                'jk' => 'nullable|in:L,P',
                'jurusan' => 'nullable|string',
                'telp' => 'nullable|string',
                'alamat' => 'nullable|string',
            ]);
            Member::updateOrCreate([
                'user_id' => auth::id()
            ], [
                'nama' => $request->nama,
                'nim' => $request->nim,
                'jk' => $request->jk,
                'jurusan' => $request->jurusan,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'created_at' => now()
            ]);
        }
        return back()->with('toast_success', 'Berhasil Melengkapi Profile');
    }
}
