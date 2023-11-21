<?php

namespace App\Http\Livewire;

use App\Models\TravelRequest;
use Livewire\Component;

class RequestSearch extends Component
{
    public $term = "";
    public $trs;

    public function mount()
    {
        $this->search();
    }

    public function search()
    {
        $this->trs = TravelRequest::search($this->term)->paginate(10);
    }

    public function render()
    {
        return view('livewire.request-search');
    }
}
