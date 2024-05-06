<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $fillable = ['name', 'jersey_number', 'team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
