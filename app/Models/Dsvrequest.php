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
        'financialmanager',
        'pl_status',
        'uh_status',
        'admin_status',
        'status'
    ];
}
