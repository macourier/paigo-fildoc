<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','email','hire_date',
        'contract_type','base_salary','weekly_hours','matricule','meta',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'meta' => 'array',
        'base_salary' => 'decimal:2',
    ];
}
