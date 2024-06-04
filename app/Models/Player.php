<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Player extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'jersey_number', 'team_id', 'photo'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function attendanceLists()
    {
        return $this->hasMany(AttendanceList::class);
    }

    public function updatePhoto(UploadedFile $photo, $storagePath = 'players')
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

    public function deletePhoto()
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

    protected function defaultPhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }
}
