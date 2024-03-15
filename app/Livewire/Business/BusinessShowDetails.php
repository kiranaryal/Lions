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
    public $isActive = false;

        public function toggleState()
    {
        $this->business = Business::find($this->id);
        if( $this->business->user->id = auth()->id() ){
            $this->business->status = !$this->business->status;
            $this->business->save();
        }
    }

    public function mount(){
        $this->id = Route::current()->parameter('business');
        $this->business = Business::find($this->id);
    }
    public function render()
    {
        return view('livewire.business.business-show-details');
    }
}
