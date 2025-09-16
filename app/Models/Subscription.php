<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'company_id',
        'plan',
        'bulletins_included',
        'bulletins_used',
        'next_billing_date',
        'price',
        'currency',
    ];

    protected $casts = [
        'next_billing_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
