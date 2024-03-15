<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;
use App\Models\BusinessCategory;
use App\Models\Profile;



class Search extends Component
{
    public $searchQuery = '';
    public $business = false;
    public $profile = false;

    public $searchResult= ['business'=>'',
                           'profile'];


    public $selectedCategoryId;

    protected $listeners = ['categorySelected'];


    public function toggleBusiness()
    {
        $this->business = 1;
        $this->profile = 0;
    }

    public function toggleProfile()
    {

        $this->profile = 1;
        $this->business = 0;
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
            })->where('status',true)->limit(10)->get();
        }
        if ($this->profile) {
            $searchCriteria .= 'Profile ';
            $this->searchResult['profile'] = Profile::where(function ($query) use ( $searchTerm) {
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('full_name', 'like', '%'.$searchTerm.'%')
                             ->orWhere('home_club', 'like', '%'.$searchTerm.'%')
                             ->orWhere('public_email', 'like', '%'.$searchTerm.'%')
                             ->orWhere('public_phone', 'like', '%'.$searchTerm.'%');
                });
            })->limit(10)->get();

        }

        $this->render();

    }


    public function categorySelected($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
        $this->business = 1;
        $this->profile = 0;
        $this->search();

    }

    public function mount(){
        $this->profile = 1;
        $this->business = 1;
        $this->searchResult['profile'] = Profile::inRandomOrder()->limit(5)->get();
        $this->searchResult['business'] = BusinessProfile::where('status',true)->inRandomOrder()->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.search');
    }
}
