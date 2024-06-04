<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ])->assignRole('admin');

        // Creates "UEFA Champions League", "Premier League", "Liga MX"
        $this->call(LeagueSeeder::class);

        // Creates "Sub 21" and "Primera División" seasons in all leagues
        $this->call(SeasonSeeder::class);

        // Creates 8 well-know euro teams in all seasons
        $this->call(TeamSeeder::class);
        // Creates one game between two random teams for each season
        // $this->call(GameSeeder::class);
    }
}
