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
        $petugas = Petugas::with('user')->SearchBy(request()->by ?? 'nama')->paginate(20);

        return view('dashboard.petugas.index',compact('petugas'));
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
