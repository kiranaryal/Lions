<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category as Cat;
class Category extends Component
{
    public $category;
    public $selectedCategory;
    public function mount(){
        $this->category = Cat::get()->all();
    }

    public function selectCategory($categoryId)
    {

        $this->dispatch('categorySelected', $categoryId);
        $this->selectedCategory= $categoryId;
    }
        public function clear(){
            $this->selectedCategory = null;
            $this->dispatch('categorySelected', $this->selectedCategory);


        }
    public function render()
    {
        return view('livewire.category');
    }
}
