<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
