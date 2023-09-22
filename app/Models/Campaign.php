<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['start_date','end_date'];

    public function getStartDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['start_date']));
    }

    public function getEndDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['end_date']));
    }
}
