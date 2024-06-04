<?php

namespace Database\Seeders;

use App\Models\Season;
use Carbon\Carbon;
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
                    'start_date' => Carbon::today(),
                    'end_date' => Carbon::today()->addMonths(6),
                    'league_id' => $i
                ]);
    }
}
