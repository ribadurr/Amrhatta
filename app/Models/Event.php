<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'photo',
        'participants',
        'coach_id',
        'duration'
    ];

    public function coach()
    {
        return $this->belongsTo(\App\Models\Coach::class);
    }

    public function members()
    {
        return $this->belongsToMany(\App\Models\Member::class, 'event_member')->withTimestamps()->withPivot('status');
    }
}