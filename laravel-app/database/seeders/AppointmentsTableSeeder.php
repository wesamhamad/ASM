<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('appointments')->insert([
            [
                'student_id' => 1,
                'dean_id' => 1,
                'coordinator_id' => 1,
                'appointment_time' => now()->addDays(1),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
