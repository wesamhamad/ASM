<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'وسام',
                'email' => 'wsam76@hotmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'فاطمة أحمد',
                'email' => 'fatima@coordinator.com',
                'password' => Hash::make('12345678'),
                'role' => 'coordinator',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'د. خالد',
                'email' => 'khaled@dean.com',
                'password' => Hash::make('12345678'),
                'role' => 'dean',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'د.سليمان السحيباني',
            //     'email' => 'suliman@dean.com',
            //     'password' => Hash::make('12345678'),
            //     'role' => 'dean',
            //     'email_verified_at' => now(),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

        ]);
    }
}