<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('superadmin'),
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'petugas-1',
            'email' => 'petugas1@mail.com',
            'password' => Hash::make('petugas123'),
            'level' => 'petugas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'member-1',
            'email' => 'member1@mail.com',
            'password' => Hash::make('member123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
