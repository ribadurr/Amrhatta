<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'title',
        'category',
        'description',
        'image',
        'event_id'
    ];

    public function members()
    {
        return $this->belongsToMany(\App\Models\Member::class);
    }

    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }
}