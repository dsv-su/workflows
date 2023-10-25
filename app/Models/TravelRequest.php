<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'created',
        'state',
        'user_id',
        'manager_id',
        'fo_id',
        'head_id',
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
        'total',
        'manager_comment_id',
        'fo_comment_id',
        'head_comment_id'
    ];
}
