<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(OrderProduct::class,'order_id');
    }

    public function orderBy()
    {
        return $this->hasOne(User::class,'id','order_by');
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

    public function carts(): Attribute
    {
        return new Attribute(
            get: fn($value) =>  Cart::whereIn('id',explode(',', $this->attributes['cart_id']))->get(),
        );
    }
    public function cartproducts(): Attribute
    {
        return new Attribute(
            get: fn($value) =>  Product::whereIn('id',explode(',', $this->attributes['product_id']))->get(),
        );
    }
}
