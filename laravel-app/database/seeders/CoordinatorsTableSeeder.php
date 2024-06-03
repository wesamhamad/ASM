<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoordinatorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('coordinators')->insert([
            [
                'user_id' => 2, // user_id of the coordinator
                'dean_id' => 1, // dean_id
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
