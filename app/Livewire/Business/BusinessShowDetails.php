<?php

namespace App\Livewire\Business;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\BusinessProfile as Business;


class BusinessShowDetails extends Component
{
    public $id;
    public $business;

    public function mount(){
        $this->id = Route::current()->parameter('business');
        $this->business = Business::find($this->id);
    }
    public function render()
    {
        return view('livewire.business.business-show-details');
    }
}
