<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChild extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_master_id',
        'item_id',
        'item_type',
        'price',
        'quantity',
    ];

    public function bakery()
    {
        return $this->belongsTo(Bakery::class, 'item_id');
    }
    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'item_id');
    }
    public function orderMaster()
    {
        return $this->belongsTo(OrderMaster::class, 'order_master_id');
    }
}
