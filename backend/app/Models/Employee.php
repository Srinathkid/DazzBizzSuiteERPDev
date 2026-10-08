<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'date_of_joining',
        'department_id',
        'designation_id',
        'manager_id',
        'employment_type',
        'status',
        'address',
        'city',
        'state',
        'pincode',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_joining' => 'date',
    ];

    // Relationships

    public function manager(): BelongsTo
    {
        return $this->belongsTo(
            Employee::class,
            'manager_id',
        );
    }

    // Employee Department Relationship

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class.'department_id');
    }

    // Employee Designation Relationship

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class.'designation_id');
    }
}
