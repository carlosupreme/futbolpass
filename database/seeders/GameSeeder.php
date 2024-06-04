<?php

namespace Database\Seeders;

use App\Models\AttendanceList;
use App\Models\Game;
use Carbon\Carbon;
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
            $game = Game::create([
                'season_id' => $i,
                'home_team_id' => $id1,
                'away_team_id' => $id2,
                'date' => Carbon::now(),
                'referee_name' => 'Juanito',
                'name' => fake()->word
            ]);

            AttendanceList::create([
                'game_id' => $game->id,
                'player_id' => rand(1, 8),
                'is_present' => true
            ]);


        }
    }
}
