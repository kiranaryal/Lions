<?php

namespace App\Livewire\Business;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Category;


class AddBusinessCategory extends ModalComponent
{
    public $category;

    public function mount(){
        $this->category = Category::get()->all();
    }



    public function render()
    {
        return view('livewire.business.add-business-category');
    }
}
