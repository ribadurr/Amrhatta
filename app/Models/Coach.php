<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'experience',
        'nip',
        'bio',
        'photo'
    ];

    public function members()
    {
        return $this->hasMany(\App\Models\Member::class);
    }

    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }
}