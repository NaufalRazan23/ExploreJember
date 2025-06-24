<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'address',
        'latitude',
        'longitude',
        'featured_image',
        'gallery',
        'entry_fee',
        'opening_hours',
        'contact_number',
        'website',
        'facilities',
        'is_featured'
    ];

    protected $casts = [
        'gallery' => 'array',
        'facilities' => 'array',
        'is_featured' => 'boolean',
        'entry_fee' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
