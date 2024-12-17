<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInformation extends Model
{
    use HasFactory;

    protected $table = 'tb_contact_informations';

    protected $fillable = [
        'address',
        'email',
        'phone_number',
        'instagram_link',
        'tiktok_link',
        'snap_link',
        'linkedIn_link'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
