<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IASuggestion extends Model
{
    protected $table = 'suggestions_ia';

    protected $fillable = [
        'label',
        'action',
        'payload',
        'confidence',
        'company_id',
    ];

    protected $casts = [
        'payload' => 'array',
        'confidence' => 'float',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
