<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable = ['name', 'logo'];

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
