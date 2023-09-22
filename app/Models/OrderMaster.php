<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'franchise_id',
        'date',
        'total_price',
        'status',
    ];

    public function orderChild()
    {
        return $this->hasMany(OrderChild::class, 'order_master_id');
    }
    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }
}
