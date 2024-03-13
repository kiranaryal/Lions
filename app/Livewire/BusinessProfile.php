<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\BusinessProfile as Business;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class BusinessProfile extends Component
{
    public $id;
    public $businessProfile;


    public function mount()
    {
        $this->id = Route::current()->parameter('user');
        $user = User::find($this->id);
        $this->businessProfile = Business::where('user_id',$user->id)->get()->all();
    }

    public function removeBusiness($id)
    {
        $business = Business::findOrFail($id);

        if ($business && $business->user->id == auth()->id()) {
            if ($business->photo) {
                Storage::disk('public')->delete($business->photo);
            }
            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }
            $business->delete();
            session()->flash('success', 'Profile extra item deleted successfully.');
        } else {
            session()->flash('error', 'Failed to delete profile extra item.');
        }
        $this->dispatch('$refresh');
        $this->render();
        $this->js('window.location.reload()');
    }
    public function render()
    {
        return view('livewire.business-profile');
    }
}
