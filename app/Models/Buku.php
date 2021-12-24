<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    protected static function newFactory()
    {
        return BookFactory::new();
    }
}
