<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use the42coders\Workflows\Triggers\WorkflowObservable;

class TravelRequest extends Model
{
    use HasFactory, WorkflowObservable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'created',
        'user',
        'name',
        'purpose',
        'project',
        'country',
        'paper',
        'contribution',
        'other',
        'departure',
        'return',
        'days',
        'flight',
        'hotel',
        'daily',
        'conference',
        'other_costs',
        'total'


    ];
}
