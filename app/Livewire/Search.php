<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;
use App\Models\BusinessCategory;


class Search extends Component
{
    public $searchQuery = '';
    public $business = false;
    public $profile = false;

    public $searchResult= ['business'=>''];


    public $selectedCategoryId;

    protected $listeners = ['categorySelected'];


    public function toggleBusiness()
    {
        $this->business = !$this->business;
    }

    public function toggleProfile()
    {
        $this->profile = !$this->profile;
    }

    public function search()
    {
        $searchCriteria = '';
        $categoryId = $this->selectedCategoryId;
        $searchTerm = $this->searchQuery;
        if ($this->business) {
            $searchCriteria .= 'Business ';
            $this->searchResult['business'] = BusinessProfile::where(function ($query) use ($categoryId, $searchTerm) {
                if ($categoryId) {
                    $query->whereHas('categories', function ($subQuery) use ($categoryId) {
                        $subQuery->where('category_id', $categoryId);
                    });
                }
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('org_name', 'like', '%'.$searchTerm.'%')
                             ->orWhere('city', 'like', '%'.$searchTerm.'%')
                             ->orWhere('email', 'like', '%'.$searchTerm.'%')
                             ->orWhere('phone', 'like', '%'.$searchTerm.'%');
                });
            })->get();

        }

        if ($this->profile) {
            $searchCriteria .= 'Profile ';

        }

$this->render();

    }


    public function categorySelected($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
        $this->search();
    }

    public function mount(){

    }






    public function render()
    {
        return view('livewire.search');
    }
}
