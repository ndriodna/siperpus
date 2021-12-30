<?php

namespace Database\Seeders;

use App\Models\Rak;
use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bukus = [
            [
                'judul'         => $judul = 'lorem1',
                'slug'          => Str::slug($judul, '-'),
                'isbn'          => '01',
                'pengarang'     => 'author1',
                'penerbit'      => 'airlangga',
                'tahun_terbit'  => '2020',
                'stok'          => '20',
                'rak_id'        => rand(1,5),
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'judul'         => $judul = 'lorem2',
                'slug'          => Str::slug($judul, '-'),
                'isbn'          => '02',
                'pengarang'     => 'author2',
                'penerbit'      => 'airlangga',
                'tahun_terbit'  => '2020',
                'stok'          => '20',
                'rak_id'        => rand(1,5),
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'judul'         => $judul = 'lorem3',
                'slug'          => Str::slug($judul, '-'),
                'isbn'          => '03',
                'pengarang'     => 'author3',
                'penerbit'      => 'airlangga',
                'tahun_terbit'  => '2020',
                'stok'          => '20',
                'rak_id'        => rand(1,5),
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'judul'         => $judul = 'lorem4',
                'slug'          => Str::slug($judul, '-'),
                'isbn'          => '04',
                'pengarang'     => 'author4',
                'penerbit'      => 'airlangga',
                'tahun_terbit'  => '2020',
                'stok'          => '20',
                'rak_id'        => rand(1,5),
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'judul'         => $judul = 'lorem5',
                'slug'          => Str::slug($judul, '-'),
                'isbn'          => '05',
                'pengarang'     => 'author5',
                'penerbit'      => 'airlangga',
                'tahun_terbit'  => '2020',
                'stok'          => '20',
                'rak_id'        => rand(1,5),
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ];

        Buku::insert($bukus);
    }
}
