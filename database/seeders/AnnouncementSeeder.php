<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Announcement::create([
            'title' => 'Final Exam Schedule',
            'content' => 'The final exams will start on May 15, 2026. Please check your dashboard for details.',
            'category' => 'Academic',
        ]);

        \App\Models\Announcement::create([
            'title' => 'Campus Maintenance',
            'content' => 'The library will be closed this Saturday for scheduled maintenance.',
            'category' => 'Urgent',
        ]);
    }
}
