<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamNames = ["Real Madrid", "FC Barcelona", "Manchester United",
                    "Bayern Munich", "Juventus", "Borussia Dortmund",
                    "Atlético Madrid", "Los Juniors"];

        for($i = 1; $i <= 6; $i++) {
            foreach($teamNames as $name) {
                $team = Team::create([
                    'name' => $name,
                    'season_id' => $i
                ]);

                Player::factory(8)->create([
                    'team_id' => $team->id
                ]);
            }
        }
    }
}
