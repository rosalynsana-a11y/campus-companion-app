<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Schedule::create([
            'subject_name' => 'Web Development',
            'subject_code' => 'IT101',
            'day_of_week' => 'Monday',
            'start_time' => '08:00:00',
            'end_time' => '11:00:00',
            'room' => 'LAB 1',
        ]);

        \App\Models\Schedule::create([
            'subject_name' => 'Database Systems',
            'subject_code' => 'IT102',
            'day_of_week' => 'Wednesday',
            'start_time' => '13:00:00',
            'end_time' => '16:00:00',
            'room' => 'LAB 2',
        ]);
    }
}
