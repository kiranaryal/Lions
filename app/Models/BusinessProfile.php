<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class BusinessProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name',
        'logo',
        'photo',
        'address',
        'city',
        'email',
        'phone',
        'website',
        'services',

        'facebook',
        'instagram',
        'linkedin',
        'about',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhoto()
    {
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        return '/storage/' . $this->photo;

    }
    public function updatePhoto($photo)
    {
        // Delete the old photo if it exists
        if ($this->photo) {
            Storage::disk('public')->delete($this->photo);
        }

        // Generate a random name for the new photo
        $randomName = Str::uuid()->toString();

        // Store the new photo with the generated name
        $path = $photo->storeAs('Business', $randomName . '.' . $photo->extension(), 'public');

        // Update the user's profile photo path in the database
        $this->update(['photo' => $path]);
    }
    public function getLogo()
    {
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }
        return '/storage/' . $this->logo;

    }
    public function updateLogo($logo)
    {
        // Delete the old logo if it exists
        if ($this->logo) {
            Storage::disk('public')->delete($this->logo);
        }

        // Generate a random name for the new logo
        $randomName = Str::uuid()->toString();

        // Store the new logo with the generated name
        $path = $logo->storeAs('Business', $randomName . '.' . $logo->extension(), 'public');

        // Update the user's profile logo path in the database
        $this->update(['logo' => $path]);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

