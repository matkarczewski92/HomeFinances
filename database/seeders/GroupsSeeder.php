<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'Stałe',
            ],
            [
                'name' => 'Jednorazowe',
            ],
            [
                'name' => 'Kredyty',
            ],
            [
                'name' => 'Oszczędności',
            ],
        ];

        DB::table('groups')->insert($groups);
    }
}
