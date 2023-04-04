<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TravelTotal extends Component
{
    public $total;
    public $flight;
    public $hotel;
    public $daily;
    public $conference;
    public $other;

    public function updatedFlight()
    {
        $this->total = (int)$this->flight + (int)$this->hotel + (int)$this->daily + (int)$this->conference + (int)$this->other;;
    }

    public function updatedHotel()
    {
        $this->total = (int)$this->flight + (int)$this->hotel + (int)$this->daily + (int)$this->conference + (int)$this->other;;
    }

    public function updatedDaily()
    {
        $this->total = (int)$this->flight + (int)$this->hotel + (int)$this->daily + (int)$this->conference + (int)$this->other;;
    }

    public function updatedConference()
    {
        $this->total = (int)$this->flight + (int)$this->hotel + (int)$this->daily + (int)$this->conference + (int)$this->other;
    }

    public function updatedOther()
    {
        $this->total = (int)$this->flight + (int)$this->hotel + (int)$this->daily + (int)$this->conference + (int)$this->other;
    }

    public function render()
    {
        return view('livewire.travel-total');
    }
}
