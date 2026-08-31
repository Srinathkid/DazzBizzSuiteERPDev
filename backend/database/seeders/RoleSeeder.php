<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full access to the application',
                'is_active' => true,
            ],
            [
                'name' => 'Billing',
                'slug' => 'billing',
                'description' => 'Access to billing and sale operations',
                'is_active' => true,
            ],
            [
                'name' => 'Store',
                'slug' => 'store',
                'description' => 'Access to inventory and purchase operations',
                'is_active' => true,
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Access to management and reports',
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
