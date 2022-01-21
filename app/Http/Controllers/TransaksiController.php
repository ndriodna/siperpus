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
        // cek jika user bukan level member
        if(auth::user()->level != 'member'){
            // ambil data transaksi dengan relasi dibatasi 20 data per halaman
            $transaksis = Transaksi::with('member','petugas','buku')->paginate(20);

            // jika request filter berdasarkan status
            if(request()->by == 'status'){
                /* ambil data transaksi ketika request dijalankan carikan data yang hampir sama
                dengan request dibatasi 20 data perhalaman*/
                $transaksis = Transaksi::with('member','petugas','buku')->when(request()->q, function($search){
                    $search->where(request()->by ?? 'status', 'like', '%'. request()->q. '%');
                })->paginate(20);

                // jika request filter berdasarkan nama
            }elseif(request()->by == 'nama'){
                /* ambil data transaksi dengan relasi petugas dan member ketika request dijalankan
                carikan data yang hampir sama dengan request dibatasi 20 data perhalaman*/
                $transaksis = Transaksi::with('member','petugas','buku')->whereHas('petugas', function($search){
                    $search->where(request()->by ?? 'petugas.nama', 'like', '%'. request()->q. '%');
                })->orWhereHas('member', function($search){
                    $search->where(request()->by ?? 'member.nama', 'like', '%'. request()->q. '%');
                })->paginate(20);

                // jika request berdasakan judul
            }elseif(request()->by == 'judul'){
                /* ambil data transaksi dengan relasi buku ketika request dijalankan
                carikan data yang hampir sama dengan request dibatasi 20 data perhalaman*/
                $transaksis = Transaksi::with('member','petugas','buku')->whereHas('buku', function($search){
                    $search->where(request()->by ?? 'buku.judul', 'like', '%'. request()->q. '%');
                })->paginate(20);
            }

            // lempar data ke dalam transaksi index
            return view('dashboard.transaksi.index', compact('transaksis'));
        }else{
            $transaksis_member = Transaksi::with('member','petugas','buku')
            ->where('member_id', auth::user()->member->id)->paginate(20);

            // jika transaksi member masih kurang dari sama dengan 0
            if($transaksis_member->count() <= 0){
                // lempar kehalam transaksi hero
                return view('dashboard.transaksi.hero', compact('transaksis_member'));
            }else{
                /* ambil data transaksi member ketika request dijalankan
                carikan data yang hampir sama dengan status yg dipilih batasi
                20 data perhalaman*/
                $transaksis_member = Transaksi::with('member','petugas','buku')
                ->where('member_id', auth::user()->member->id)->when(request()->q, function($search){
                    $search->where('status','like', '%'.request()->q.'%');
                })->paginate(20);
                // lempar data kedalam transaski member
                return view('dashboard.transaksi.member', compact('transaksis_member'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['hari' => 'required']);
        // insert data kedalam database
        Transaksi::create([
            'tgl_pinjam' => now(),
            'hari' => $request->hari,
            'buku_id' => $request->buku_id,
            'member_id' => Auth::user()->member->id,
            'status' => 'menunggu verifikasi',
        ]);

        // kembali kehalaman transaksi index
        return redirect(route('transaksi.index'));
    }

    public function pinjam(Request $request, $slug)
    {
        // ambil data buku sesuai slug
        $buku = Buku::where('slug', $slug)->first();

        // passing variabel buku kedalam view
        return view('dashboard.transaksi.create', compact('buku'));
    }

    public function verifikasi($id,$hari)
    {
        // ambil data transaksi sesuai id
        $transaksi = Transaksi::findOrFail($id);

        // update data transaksi
        $transaksi->update([
            'status' => 'pinjam',
            'tgl_kembali' => Carbon::now()->addDays($hari),
            'petugas_id' => Auth::user()->petugas->id,
        ]);

        // kirim email sesuai email member dan kirim variabel transaksi
        mail::to($transaksi->member->user->email)->send(new VerifikasiBuku($transaksi));

        $transaksi->buku->where('id', $transaksi->buku_id)->update([
            'stok' => $transaksi->buku->stok - 1
        ]);

        // kembali kehalaman yg sama dengan toast
        return back()->with('toast_success', 'Buku Berhasil Diverifikasi!');
    }

    public function kembali($id)
    {
        // ambil data transaksi berdasarkan user yang sedang login
        $transaksi = Transaksi::with('member','petugas','buku')
        ->where('member_id', auth::user()->member->id)->findOrFail($id);

        // variabel yg menampung array
        $data = [
            'status' => 'kembali',
            'denda' => 0,
            'tgl_pengembalian' => now(),
        ];

        // buat tgl_kembali menjadi carbon
        $tgl_kembali = Carbon::create($transaksi->tgl_kembali);

        // check apakah tanggal kembali lebih kecil dari tanggal hari ini
        if($tgl_kembali->lessThan((today()))){
            // jika iya, hitung selesih dari tanggal kembali dengan hari ini
            $denda = Carbon::create($transaksi->tgl_kembali)->diffInDays(today());
            // setiap selisih di kalikan 1000
            $denda *= 1000;
            // masukan variabel denda kedalam varibel data
            $data['denda'] = $denda;
        }

        // update data transaksi menggunakan variabel $data
        $transaksi->update($data);

        // update stok buku berdasarkan id
        $transaksi->buku->where('id', $transaksi->buku_id)->update([
            'stok' => $transaksi->buku->stok + 1
        ]);

        // kembali kehalaman yg sama dengan toast success
        return back()->with('toast_success', 'Buku Berhasil Dikembalikan!');
    }

}
