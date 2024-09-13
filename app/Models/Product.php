<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'id_category',
        'id_brand',
        'option',
        'discount_percentage',
        'company',
        'id_user',
        'images',
        'detail',
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }
}
