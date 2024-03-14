<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News as NewsModel;

class News extends Component
{
    public $news;

    public function mount(){
        $this->news = NewsModel::where('status', true)
        ->orderBy('date', 'desc') // Assuming 'date' is the column containing the date
        ->take(10) // Limit to 10 results
        ->get();
    }

    public function render()
    {
        return view('livewire.news');
    }
}
