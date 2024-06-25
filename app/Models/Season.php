<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Season extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'league_id', 'start_date', 'end_date'];

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
