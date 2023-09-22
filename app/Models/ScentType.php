<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScentType extends Model
{
    use HasFactory;
    protected $table = 'scent_types';
    protected $fillable = [
        'name'
    ];

    public function Product() {
        return $this->belongsTo(Product::class, 'scent_type_id');
    }
}
