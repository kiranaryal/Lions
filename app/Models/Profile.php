<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'full_name',
        'position',
        'home_club',
        'public_email',
        'public_phone',
        'nationality',
        'city',
        'address',
        'about',
        'photo',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profileExtra()
    {
        return $this->hasMany(ProfileExtra::class);
    }

    public function getImage()
    {
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        return '/storage/' . $this->photo;

    }
    public function updatePhoto($photo)
    {
        if ($this->photo) {
            Storage::disk('public')->delete($this->photo);
        }
        $randomName = Str::uuid()->toString();
        $path = $photo->storeAs('profiles', $randomName . '.' . $photo->extension(), 'public');
        $this->update(['photo' => $path]);
    }
}
