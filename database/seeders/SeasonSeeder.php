<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasonNames = ["Sub 21", "Primera División"];

        for ($i = 1; $i <= 3; $i++) 
            foreach ($seasonNames as $name) 
                Season::create([
                    'name' => $name,
                    'start_date' => '2024-03-06 00:00:00',
                    'end_date' => '2024-03-15 00:00:00',
                    'league_id' => $i
                ]);
    }
}
