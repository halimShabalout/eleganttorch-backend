<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunictionRequest extends Model
{
    use HasFactory;

    protected $table = 'tb_communiction_requests';

    protected $fillable = [
        'customer_name',
        'email',
        'phone_number',
        'message',
        'is_active'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
