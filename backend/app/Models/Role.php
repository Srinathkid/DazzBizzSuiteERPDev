<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',

    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions'
        );

    }

    

    /*public function hasPermission(string $permission): bool
    {
        if (! $this->is_active) {
            return false;
        }

         if (! $this->role || ! $this->role->is_active) {
        return false;
    }

        return $this->role
        ->permissions()
            ->where('slug', $permission)
            ->where('permissions.is_active', true)
            ->exists();
    }*/

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
