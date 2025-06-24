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

    /**
     * Destination's visit forms
     */
    public function visitForms()
    {
        return $this->hasMany(\App\Models\VisitForm::class);
    }

    /**
     * Get total visitors count for this destination
     * Counts actual number of people (1 for sendirian, group_size for rombongan)
     */
    public function getTotalVisitorsAttribute()
    {
        return $this->visitForms()
            ->selectRaw('SUM(CASE
                WHEN visit_type = "sendirian" THEN 1
                WHEN visit_type = "rombongan" THEN group_size
                ELSE 0
            END) as total')
            ->value('total') ?? 0;
    }
}
