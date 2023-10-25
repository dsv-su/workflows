<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'created',
        'user_id',
        'manager_id',
        'fo_id',
        'head_id',
        'name',
        'state',
        'status'
    ];
}
