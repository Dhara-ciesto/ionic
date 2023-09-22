<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FragranceTone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','tone_binary_digit','video'
    ];
}
