<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    protected $fillable = ['name', 'season_id', 'logo'];

    public function season() {
        return $this->belongsTo(Season::class);
    }

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function games() {
        return $this->belongsToMany(Game::class);
    }
}
