<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(OrderProduct::class,'order_id');
    }
    // public function getProductsAttribute()
    // {
    //     $monitorId = $this->product;
    //     return $monitorId;
    //     return Product::whereIn('id', explode(',', $monitorId))->get();
    // }
    // public function setProductsAttribute($value)
    // {
    //     $monitorId = $this->product;
    //     return $monitorId;
    //     return Product::whereIn('id', explode(',', $monitorId))->get();
    // }

    // public function products(): Attribute
    // {
    //     return new Attribute(
    //         get: fn($value) =>  Product::whereIn('id',explode(',', $this->attributes['product']))->get(),
    //     );
    // }
}
