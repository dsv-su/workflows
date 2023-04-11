<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Searchable\Searchable;

class Project extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $fillable = [
        'project',
        'description',
        'projectleader',
        'status'
    ];

    protected $searchable = [
        'columns' => [
            'project' => 10,
            'description' => 9,
            'projectleader' => 8,
            'status' => 1
        ]
    ];
}
