<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory, HelperTrait;

    protected $guarded = [];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
