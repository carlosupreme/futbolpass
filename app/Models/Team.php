<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{

    protected $fillable = ['name', 'season_id', 'logo'];

    protected $appends = ['logo_url'];


    public function updatePhoto(UploadedFile $photo, $storagePath = 'teams')
    {
        tap($this->foto, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'logo' => $photo->storePublicly($storagePath, ['disk' => 'public']),
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }

    public function deletePhoto()
    {
        if (is_null($this->logo)) return;

        Storage::disk('public')->delete($this->logo);

        $this->forceFill([
            'logo' => null,
        ])->save();
    }

    public function logoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->logo
                ? Storage::disk('public')->url($this->logo)
                : "/logo-equipo-default.avif";
        });
    }


    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
