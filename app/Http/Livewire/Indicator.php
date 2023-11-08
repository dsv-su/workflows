<?php

namespace App\Http\Livewire;

use App\Models\Dashboard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Statamic\Auth\User;

class Indicator extends Component
{
    public $auth_user;
    public $user_roles;
    public $dashboard;

    public function mount()
    {
        $this->dashboard = null;
        $this->user_roles = $this->getUserRoles();
        $this->checkDashboard();
    }

    public function checkDashboard()
    {
        //Check dashboard
        $manager = collect(Dashboard::where('state', 'submitted')->where('manager_id', $this->auth_user)->get());
        $fo = collect(Dashboard::where('state', 'manager_approved')->where('fo_id', $this->auth_user)->get());
        $head = collect(Dashboard::where('state', 'fo_approved')->where('head_id', $this->auth_user)->get());
        $this->dashboard = $manager->merge($fo)->merge($head);
    }

    public function hydrate()
    {
        $this->checkDashboard();
    }

    private function getUserRoles()
    {
        $this->auth_user = Auth::user()->id;
        $user = User::find($this->auth_user);
        $userrole = collect($user->roles());
        return $userrole->keys()->all();
    }

    public function render()
    {
        return view('livewire.indicator');
    }
}
