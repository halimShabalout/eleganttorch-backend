<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'tb_sub_categories';

    protected $fillable = [
        'sub_category_name',
        'description',
        'category_id',
        'customer_id'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
