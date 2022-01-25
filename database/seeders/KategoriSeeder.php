<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            [
                'nama' => 'dummy1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'dummy2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'dummy3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'dummy4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'dummy5',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Kategori::insert($kategoris);
    }
}
