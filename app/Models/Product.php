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
        'image',
        'product_category_id',
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
