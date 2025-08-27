<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'ticket_price',
        'start_date',
        'end_date',
        'draw_time',
        'cause',
        'banner',
        'rules',
        'max_tickets_per_user',
        'created_by',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
