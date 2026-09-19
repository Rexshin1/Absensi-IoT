<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_category',
        'fingerprint_id',
    ];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}