<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Player extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'jersey_number', 'team_id', 'photo'];

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function attendanceLists(): HasMany
    {
        return $this->hasMany(AttendanceList::class);
    }

    public function updatePhoto(UploadedFile $photo, $storagePath = 'players'): void
    {
        tap($this->photo, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'photo' => $photo->storePublicly($storagePath, ['disk' => 'public']),
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }

    public function deletePhoto(): void
    {
        if (is_null($this->photo)) return;

        Storage::disk('public')->delete($this->photo);

        $this->forceFill([
            'photo' => null,
        ])->save();
    }

    public function photoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->photo
                ? Storage::disk('public')->url($this->photo)
                : $this->defaultPhotoUrl();
        });
    }

    protected function defaultPhotoUrl(): string
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }
}
