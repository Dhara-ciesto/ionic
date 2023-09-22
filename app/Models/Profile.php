<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'video',
        'university',
        'education',
        'other_qualification',
        'roles',
        'cv',
    ];
    // protected $casts = [
    //     'education' => 'array',
    //     'university' => 'array',

    // ];
}
