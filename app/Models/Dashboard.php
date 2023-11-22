<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Get the user that belongs to the dashboard.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the travelrequest that belongs to the dashboard.
     */
    public function travel(): BelongsTo
    {
        return $this->belongsTo(TravelRequest::class, 'request_id');
    }
}
