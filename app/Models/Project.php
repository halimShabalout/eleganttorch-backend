<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'tb_projects';

    protected $fillable = [
        'project_name',
        'location',
        'description',
        'date',
        'images',
        'video',
        'is_active'
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
