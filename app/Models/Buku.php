<?php

namespace App\Models;

use App\Models\Rak;
use App\Models\Transaksi;
use App\Traits\HelperTrait;
use Illuminate\Support\Str;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory, HelperTrait;

    protected $guarded = [];

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }

    protected static function newFactory()
    {
        return BookFactory::new();
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getCoverAttribute($cover)
    {
        if($cover != null){
            return asset('storage/covers/'. $cover);
        }else{
            return asset('cover-default.svg');
        }
    }
}
