<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'nisn',
        'grade_class',
        'position',
        'join_date',
        'coach_id',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function achievements()
    {
        return $this->belongsToMany(\App\Models\Achievement::class);
    }

    public function coach()
    {
        return $this->belongsTo(\App\Models\Coach::class);
    }

    public function events()
    {
        return $this->belongsToMany(\App\Models\Event::class, 'event_member')->withTimestamps()->withPivot('status');
    }
}
