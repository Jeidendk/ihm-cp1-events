<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'title',
        'date',
        'time',
        'timezone',
        'description',
        'status',
        'location_id',
        'contact_id',
        'has_reminder',
        'repetition',
        'classification',
    ];

    protected $casts = [
        'date' => 'date',
        // 'time' => 'datetime', // Time casting can be tricky, often string is better or custom cast
        'has_reminder' => 'boolean',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
