<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Event::create([
            'title' => 'Campus Foundation Day',
            'description' => 'Celebrating the 50th anniversary of our campus with various activities and performances.',
            'event_date' => '2026-06-10 09:00:00',
            'location' => 'Main Gymnasium',
        ]);

        \App\Models\Event::create([
            'title' => 'IT Seminar: Future of AI',
            'description' => 'A seminar discussing the impact of AI on the future of technology.',
            'event_date' => '2026-06-15 14:00:00',
            'location' => 'Audio Visual Room',
        ]);
    }
}
