<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\User;
class BusinessProfile extends Component
{
    public $id;
    public $businessProfile;


    public function mount()
    {
        $this->id = Route::current()->parameter('user');
        $user = User::find($this->id);
        $this->buinessProfile = $user->businessProfile;

    }

    public function render()
    {
        return view('livewire.business-profile');
    }
}
