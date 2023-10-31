<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'name',
        'state',
        'created',
        'status',
        'type',
        'user_id',
        'manager_id',
        'fo_id',
        'head_id'

    ];
}
