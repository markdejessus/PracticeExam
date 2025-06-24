<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reports_to',
    ];

    public function reportsTo(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'reports_to');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(Position::class, 'reports_to');
    }
}
