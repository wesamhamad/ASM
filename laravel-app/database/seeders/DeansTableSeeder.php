<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeansTableSeeder extends Seeder
{
    public function run()
    {
        $deans = [
            [
                'user_id' => 3, // user_id of the dean
                'coordinator_id' => 1, // user_id of the coordinator
                'department' => 'علوم الحاسب',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more deans if needed
        ];

        foreach ($deans as $deanData) {
            // Create time slots for the dean
            $slots = [];
            $startTime = Carbon::parse('09:00');
            $endTime = Carbon::parse('12:00');
            while ($startTime < $endTime) {
                $slots[] = [
                    'time' => $startTime->toDateTimeString(),
                    'status' => 'available'
                ];
                $startTime->addMinutes(30);
            }
            $deanData['time_slots'] = json_encode($slots);

            // Insert the dean with time slots
            DB::table('deans')->insert($deanData);
        }
    }
}
