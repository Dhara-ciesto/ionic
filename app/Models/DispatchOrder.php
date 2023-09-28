<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchOrder extends Model
{
    use HasFactory;
    protected $table = 'dispatch_products';
    protected $guarded = [];
}
