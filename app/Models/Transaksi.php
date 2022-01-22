<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded=[];

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
