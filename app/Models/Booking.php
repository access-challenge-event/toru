<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'event_id',
        'user_id',
        'name',
        'email',
        'phone',
        'tickets',
        'special_requirements',
        'status',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public static function generateReference(): string
    {
        do {
            $reference = 'DA-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }
}
