<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tb_customers';

    protected $fillable = [
        'logo',
        'company_name',
        'address',
        'phone_number',
        'email',
        'contact_person',
        'commercial_record',
        'tax_number'
    ];

    protected $guarded = [];

    // Optional: if you want to set custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Optional: Mutators/Accessors for logo or any other field
    public function getLogoAttribute($value)
    {
        return asset('storage/logos/' . $value);
    }

    // Define relationships if needed, for example if you have a relationship with 'projects'
    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }
}
