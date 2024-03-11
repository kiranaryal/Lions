<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Route;
use App\Models\ProfileExtra;




class ProfileFormExtra extends Component
{
    use WithFileUploads;
    public $id;

    public $profile;
    public $profileExtras = [];

    public $category;
    public $org_name;
    public $position;
    public $date;
    public $photo;

    public $showForm = false;

    // Other properties and methods...

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }


    public function mount()
    {
        $this->id = Route::current()->parameter('user');

        $user = User::find($this->id);
        $this->profileExtra = $user->profile->profileExtra;
    }


    public function store()
    {
        $profileExtras =  $this->validate([
            'category' => '',
            'org_name' => '',
            'position' => '',
            'date' => '',
            'photo' => '',

        ]);
        if (auth()->user()->id != $this->id) {
            abort(403, 'Unauthorized action.');
        }

        $profile = ProfileExtra::create([
            'category' => $this->category,
            'org_name' => $this->org_name,
            'position' => $this->position,
            'date' => $this->date,
            'profile_id'=>auth()->user()->profile->id,

        ]);
        if ($this->photo) {
            $profile->updatePhoto($this->photo);
        }
        $this->showForm = false;
        $this->js('window.location.reload()');


    }
    public function closeModal()
    {
        $this->showForm = false;
    }



    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:20048', // Adjust the max file size as needed
        ]);
    }


    public function render()
    {
        return view('livewire.profile-form-extra');
    }
}
