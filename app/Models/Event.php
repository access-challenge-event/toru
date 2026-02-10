<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'image',
        'category',
        'location',
        'start_date',
        'end_date',
        'capacity',
        'spots_remaining',
        'is_free',
        'price',
        'status',
        'featured',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_free' => 'boolean',
        'featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getIsFullAttribute(): bool
    {
        return $this->spots_remaining <= 0;
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->start_date->format('l, j F Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        return $this->start_date->format('g:ia') . ' – ' . $this->end_date->format('g:ia');
    }

    public function getAvailabilityPercentageAttribute(): int
    {
        if ($this->capacity === 0) return 0;
        return (int) round(($this->spots_remaining / $this->capacity) * 100);
    }
}
