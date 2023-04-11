<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dsvrequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'requestid',
        'type',
        'projectleader',
        'unithead',
        'pl_status',
        'uh_status',
        'status'
    ];
}
