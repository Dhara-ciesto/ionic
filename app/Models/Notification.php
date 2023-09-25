<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $guarded = [];
    protected $dates = [
        'send_date',
    ];
    public function setSendTimeAttribute($value)
    {
        $this->attributes['send_time'] = Carbon::parse($value);
    }
}
