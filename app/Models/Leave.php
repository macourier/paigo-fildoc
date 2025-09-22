<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'type',
        'start_date',
        'end_date',
        'status',
        'reason',
        'meta',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'meta' => 'array',
    ];

    // Jours (simplifié) = diff en jours + 1
    protected function days(): Attribute
    {
        return Attribute::get(function () {
            if (!$this->start_date || !$this->end_date) {
                return null;
            }

            return $this->start_date->diffInDays($this->end_date) + 1;
        });
    }

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class);
    }
}
