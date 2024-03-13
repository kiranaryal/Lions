<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Route;
use App\Models\User;

class ProfileForm extends Component
{
    use WithFileUploads;
    public $id;
    public $profile;
    public $full_name;
    public $position;
    public $home_club;
    public $public_email;
    public $public_phone;
    public $nationality;
    public $city;
    public $address;
    public $about;
    public $photo;

    public function render()
    {
        return view('livewire.profile-form');
    }
    public function mount()
    {
        $this->id = Route::current()->parameter('user');

        $user = User::find($this->id);
        $profile = $user->profile;
        $this->profile = $profile;
        if ($profile) {
            $this->full_name = $profile->full_name;
            $this->position = $profile->position;
            $this->home_club = $profile->home_club;
            $this->public_email = $profile->public_email;
            $this->public_phone = $profile->public_phone;
            $this->nationality = $profile->nationality;
            $this->city = $profile->city;
            $this->address = $profile->address;
            $this->about = $profile->about;
            $this->photo = $profile->getImage();
        }
    }
    public function updatedPhoto()
    {
        if (auth()->user()->id != $this->id) {
            abort(403, 'Unauthorized action.');
        }

        $this->validate([
            'photo' => 'image|max:20048', // Adjust the max file size as needed
        ]);
        auth()->user()->profile->updatePhoto($this->photo);

    }


    public function store()
    {

        $input =  $this->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'home_club' => 'required|string|max:255',
            'public_email' => 'required|email|max:255',
            'public_phone' => 'required|string|max:20',
            'nationality' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'about' => 'required|string',
            'photo'=>''

        ]);
        if (auth()->user()->id != $this->id) {
            abort(403, 'Unauthorized action.');
        }


        $pro = auth()->user()->profile()->update([
        'full_name' => $this->full_name,
        'position' => $this->position,
        'home_club' => $this->home_club,
        'public_email' => $this->public_email,
        'public_phone' => $this->public_phone,
        'nationality' => $this->nationality,
        'city' => $this->city,
        'address' => $this->address,
        'about' => $this->about,
        ]);
    $this->render();
    }


}
