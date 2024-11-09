<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'tb_projects';

    protected $fillable = [
        'project_name',
        'location',
        'description',
        'start_date',
        'end_date',
        'images',
        'video',
        'is_active',
        'customer_id'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Optional: Mutators/Accessors for images or any other field
    public function getImagesAttribute($value)
    {
        return asset('storage/projects/images/' . $value);
    }

    // Optional: Mutators/Accessors for videos or any other field
    public function getVideosAttribute($value)
    {
        return asset('storage/projects/videos/' . $value);
    }
}
