<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = ['name', 'season_id'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
