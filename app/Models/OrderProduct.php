<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    protected $guarded = [];
    protected $appends = ['dispatch_count'];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function dispatch_product()
    {
        return $this->hasMany(DispatchOrder::class,'order_product_id','id');
    }


    public function getDispatchCountAttribute()
    {
        return DispatchOrder::where('order_product_id',$this->attributes['id'])->sum('cartoon');
        // return date('d-m-Y', strtotime($this->attributes['start_date']));
    }
}
