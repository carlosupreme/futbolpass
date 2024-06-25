<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class League extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'logo'];
    protected $appends = ['logo_url'];

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

    public function updatePhoto(UploadedFile $photo, $storagePath = 'leagues'): void
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

    public function deletePhoto(): void
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
                : '/villa7-default-liga.jpeg';
        });
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }
}
