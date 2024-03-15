<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\ProfileExtra;
use App\Models\Profile;

use App\Models\User;
use Livewire\WithFileUploads;


class ProfileFormDetails extends Component
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
    public $profileExtra;
    public $profileExtraId;




    public function mount()
    {

        $this->id = Route::current()->parameter('user');
        $user = User::find($this->id);
        $this->profileExtra = Profile::where('user_id',$user_id)->profileExtra;
    }


    public function removeProfileExtra($profileExtraId)
    {
        $profileExtraItem = ProfileExtra::find($profileExtraId);

        if ($profileExtraItem && $profileExtraItem->profile->user->id == auth()->id()) {
            $profileExtraItem->delete();

            session()->flash('success', 'Profile extra item deleted successfully.');
        } else {
            session()->flash('error', 'Failed to delete profile extra item.');
        }
        $this->dispatch('$refresh');

        $this->render();
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
        if (auth()->user()->id != $this->id) {
            abort(403, 'Unauthorized action.');
        }

        $profile = ProfileExtra::find($profileExtra)->update([
            'category' => $this->category,
            'org_name' => $this->org_name,
            'position' => $this->position,
            'date' => $this->date,
            'profile_id'=>auth()->user()->profile->id,

        ]);

    $this->js('window.location.reload()');

    }

    public function updatedPhoto($id)
    {
        if (auth()->user()->id != $this->id) {
            abort(403, 'Unauthorized action.');
        }
        $this->validate([
            'photo' => 'image|max:20048', // Adjust the max file size as needed
        ]);
        $this->profileExtra->updatePhoto($this->photo);

    }


    public function render()
    {
        return view('livewire.profile-form-details');
    }
}
