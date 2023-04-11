<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\TravelRequest;
use Livewire\Component;

class TravelTotal extends Component
{
    public $total;
    public $flight;
    public $hotel;
    public $daily;
    public $conference;
    public $other;
    public $days;
    public $countryname;

    protected $listeners = [
        'getDays', 'countryAllowance'
    ];


    public function mount()
    {
        $this->days = 0;
    }

    public function getDays($value)
    {
        $this->days = $value;
        $this->summarize();
    }

    public function countryAllowance($id)
    {
        $country = Country::find($id);
        $this->daily = $country->allowance;
        $this->countryname = $country->country;
        $this->summarize();
    }

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
        $this->total = (int)$this->flight + (int)$this->hotel + ((int)$this->daily * $this->days) + (int)$this->conference + (int)$this->other;
    }
}
