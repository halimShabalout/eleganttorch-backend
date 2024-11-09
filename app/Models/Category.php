<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tb_categories';

    protected $fillable = [
        'category_name',
        'description',
        'department_id',
        'customer_id'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
