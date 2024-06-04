<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For each Season, it creates a games between two random teams
        for($i = 1; $i <= 6; $i++) {
            $id1 = rand(1,8);
            $id2 = rand(1,8);
            Game::create([
                'season_id' => $i,
                'home_team_id' => $id1,
                'away_team_id' => $id2,
                'date' => '2024-06-07',
                'referee_name' => 'Juanito'
            ]);
        }
    }
}
