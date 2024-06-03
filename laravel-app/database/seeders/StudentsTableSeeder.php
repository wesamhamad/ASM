<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            [
                'user_id' => 1, // user_id of the student
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
