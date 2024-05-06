<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['name', 'league_id', 'start_date', 'end_date'];

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
