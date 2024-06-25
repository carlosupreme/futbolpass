<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('season_id')->constrained('seasons');
            $table->foreignUuid('home_team_id')->constrained('teams');
            $table->foreignUuid('away_team_id')->constrained('teams');
            $table->timestamp("date");
            $table->integer("home_team_goals")->default(0);
            $table->integer("away_team_goals")->default(0);
            $table->string("name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
