<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Route;
use App\Models\ProfileExtra;
use LivewireUI\Modal\ModalComponent;
class EditDetails extends ModalComponent
{
    use WithFileUploads;

    public int $id;
    public $profile;
    public $profileExtras = [];

    public $category;
    public $org_name;
    public $position;
    public $date;
    public $photo;
    public $profileExtra;
    public $profileExtraId;


    public function mount()
    {
        $profileExtraItem = ProfileExtra::find($this->id);

        if ($profileExtraItem && $profileExtraItem->profile->user->id == auth()->id()) {
            $this ->profileExtra =  $profileExtraItem;
            $this ->profileExtraId =  $profileExtraItem->id;

            $this->org_name = $profileExtraItem->org_name;
            $this->position = $profileExtraItem->position;
            $this->category = $profileExtraItem->category;

            $this->photo = $profileExtraItem->getImage();

        } else {
        }

        $this->dispatch('$refresh');

        $this->render();
        }
    public function render()
    {
        return view('livewire.profile.edit-details');
    }
    public function update($profileExtra)
    {

        $profileExtras =  $this->validate([
            'category' => '',
            'org_name' => '',
            'position' => '',
            'date' => '',
            'photo' => '',

        ]);
        $profile = ProfileExtra::find($profileExtra)->update([
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
    public function updatedPhoto($id)
    {

        $this->validate([
            'photo' => 'image|max:20048', // Adjust the max file size as needed
        ]);
        $this->profileExtra->updatePhoto($this->photo);


    }
}
