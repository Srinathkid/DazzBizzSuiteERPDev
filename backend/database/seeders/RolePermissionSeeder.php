<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', 'admin')->firstOrFail();
        $billing = Role::where('slug', 'billing')->firstOrFail();
        $store = Role::where('slug', 'store')->firstOrFail();
        $manager = Role::where('slug', 'manager')->firstOrFail();

        // Admin
        $admin->permissions()->sync(
            Permission::where('is_active', true)->pluck('id')
        );

        // Billing
        $billingPermissions = [
            'customers.view',
            'customers.create',
            'customers.update',

            'vendors.view',

            'sales.view',
            'sales.create',
            'sales.update',
            'sales.cancel',
            'sales.return',

            'quotes.view',
            'quotes.create',
            'quotes.update',
            'quotes.convert',

            'reports.view',
        ];

        $billing->permissions()->sync(
            Permission::whereIn('slug', $billingPermissions)->pluck('id')
        );

        // Store
        $storePermissions = [
            'vendors.view',

            'companies.view',
            'companies.create',
            'companies.update',

            'products.view',
            'products.create',
            'products.update',

            'items.view',
            'items.create',
            'items.update',

            'stock.view',
            'stock.create',
            'stock.update',

            'purchase.view',
            'purchase.create',
            'purchase.update',
            'purchase.return',

            'reports.view',
        ];

        $store->permissions()->sync(
            Permission::whereIn('slug', $storePermissions)->pluck('id')
        );

        // Manager
        $managerPermissions = [
            'customers.view',
            'customers.create',
            'customers.update',

            'vendors.view',

            'companies.view',

            'products.view',

            'items.view',

            'stock.view',

            'purchase.view',

            'sales.view',

            'quotes.view',

            'reports.view',
            'reports.export',
        ];

        $manager->permissions()->sync(
            Permission::whereIn('slug', $managerPermissions)->pluck('id')
        );

    }
}
