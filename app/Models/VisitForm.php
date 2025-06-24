<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_id',
        'visit_date',
        'arrival_time',
        'departure_time',
        'visit_type',
        'group_size',
        'suggestions',
        'review'
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
