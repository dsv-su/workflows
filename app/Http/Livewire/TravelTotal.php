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
        $this->summarize();
    }

    public function updatedHotel()
    {
        $this->summarize();
    }

    public function updatedDaily()
    {
        $this->summarize();
    }

    public function updatedConference()
    {
        $this->summarize();
    }

    public function updatedOther()
    {
        $this->summarize();
    }

    public function render()
    {
        return view('livewire.travel-total');
    }

    private function summarize()
    {
        $this->total = (int)$this->flight + (int)$this->hotel + (int)$this->daily + (int)$this->conference + (int)$this->other;
    }
}
