<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Franchise extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'franchise_code',
        'franchise_name',
        'city_id',
        'area_id',
        'address',
        'pincode',
        'phone_no',
        'mobile_no',
        'status',
        'password'
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
