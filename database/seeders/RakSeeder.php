<?php

namespace Database\Seeders;

use App\Models\Rak;
use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raks = [
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

        Rak::insert($raks);
    }
}
