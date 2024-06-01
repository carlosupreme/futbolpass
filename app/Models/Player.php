<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $fillable = ['name', 'jersey_number', 'team_id', 'photo'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
