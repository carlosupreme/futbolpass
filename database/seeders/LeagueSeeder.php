<?php

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $leagueNames = ["UEFA Champions League", "Premier League", "Liga MX"];

        foreach($leagueNames as $name)
            League::create([
                'name' => $name
            ]);
    }
}
