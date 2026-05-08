<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Location::create([
            'name' => 'Main Library',
            'description' => 'The central hub for research and study.',
            'latitude' => 10.3157,
            'longitude' => 123.8854,
        ]);

        \App\Models\Location::create([
            'name' => 'IT Building',
            'description' => 'Home of the College of Information Technology.',
            'latitude' => 10.3165,
            'longitude' => 123.8860,
        ]);

        \App\Models\Location::create([
            'name' => 'Student Pavilion',
            'description' => 'Food court and student activity area.',
            'latitude' => 10.3170,
            'longitude' => 123.8845,
        ]);
    }
}
