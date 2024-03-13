<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use App\Models\ProfileExtra;
use LivewireUI\Modal\ModalComponent;

class AddDetails extends ModalComponent
{

    use WithFileUploads;
    public $profile;
    public $profileExtras = [];
    public $category;
    public $org_name;
    public $position;
    public $date;
    public $photo;
    public int $user;


    public function mount()
    {
        $user = User::find($this->user);
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
        else{

            $this->closeModal();
            $this->js('window.location.reload()');
        }


    }


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:20048', // Adjust the max file size as needed
        ]);
    }

    public function render()
    {
        return view('livewire.profile.add-details');
    }
}
