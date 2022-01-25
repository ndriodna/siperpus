<?php

namespace App\Models;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory, HelperTrait;

    protected $fillable = ['nama'];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
