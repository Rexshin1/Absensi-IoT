<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id',
        'heart_rate',
        'user_id',
        'attendance_date',
        'status',
        'note',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'heart_rate' => 'integer',
    ];

    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}