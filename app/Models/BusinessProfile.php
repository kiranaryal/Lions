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
        'facebook',
        'instagram',
        'linkedin',
        'about',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        return '/storage/' . $this->photo;

    }
    public function updateLogo($photo)
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

}
