<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('superadmin'),
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'petugas-1',
                'email' => 'petugas1@mail.com',
                'password' => Hash::make('petugas123'),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'member-1',
                'email' => 'member1@mail.com',
                'password' => Hash::make('member123'),
                'level' => 'member',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        User::insert($users);
    }
}
