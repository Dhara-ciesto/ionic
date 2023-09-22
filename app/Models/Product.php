<?php

namespace App\Models;

use App\Models\ProductBrand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function product_brand()
    {
        return $this->HasOne(ProductBrand::class, 'id', 'product_brand_id');
    }

    public function fragrance_tone_1()
    {
        return $this->HasOne(FragranceTone::class, 'id','fragrance_tone_1_id');
    }

    public function fragrance_tone_2()
    {
        return $this->HasOne(FragranceTone::class, 'id', 'fragrance_tone_2_id');
    }

    public function size_unit()
    {
        return $this->HasOne(Unit::class, 'id', 'size_unit_id');
    }

    public function scent_type()
    {
        return $this->HasOne(ScentType::class, 'id', 'scent_type_id');
    }

    public function campaign()
    {
        return $this->HasOne(Campaign::class, 'id', 'campaign_id');
    }


    // public function getSizeAttribute()
    // {
    //     return $this->attributes['size'].Unit::where('id', $this->size_unit)->pluck('name')->first();
    // }

}
