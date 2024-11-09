<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tb_products';

    protected $fillable = [
        'product_name',
        'images',
        'description',
        'price',
        'price_after_discount',
        'quantity',
        'is_price_visible',
        'is_active',
        'sub_category_id',
        'customer_id'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Optional: Mutators/Accessors for images or any other field
    public function getImagesAttribute($value)
    {
        return asset('storage/products/images/' . $value);
    }
}
