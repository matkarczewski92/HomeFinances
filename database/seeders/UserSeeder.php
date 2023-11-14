<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'mateusz',
            'email' => 'matkarczewski92@gmail.com',
            'password' => '$2y$12$gLa5QVHnxmKUNt2QXZFIl./qX5CzQUWWZpcBWgwhXy3aMmypioTou',
            'admin' => 1,
            'avatar' => 'https://avatars.githubusercontent.com/u/65907188?v=4',
        ]);
        DB::table('users')->insert([
            'name' => 'magda',
            'email' => 'magdakarczewska7@gmail.com',
            'password' => '$2y$12$gLa5QVHnxmKUNt2QXZFIl./qX5CzQUWWZpcBWgwhXy3aMmypioTou',
        ]);
    }
}
