<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfileExtra extends Model
{

    use HasFactory;
    protected $guarded = [];
    public function profile()
    {
        return $this->belongsTo(Profile::class);
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
        $path = $photo->storeAs('profilesExtra', $randomName . '.' . $photo->extension(), 'public');

        // Update the user's profile photo path in the database
        $this->update(['photo' => $path]);
    }
}
