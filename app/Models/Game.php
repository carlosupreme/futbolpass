<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {
    use HasFactory;

    protected $fillable = ['season_id', 'home_team_id', 'away_team_id', 'date', 'referee_name'];

    public function home_team() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function away_team() {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function season() {
        return $this->belongsTo(Season::class);
    }

}
