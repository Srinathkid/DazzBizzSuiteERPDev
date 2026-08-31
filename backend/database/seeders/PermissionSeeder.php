<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // Customers
            [
                'name' => 'View Customers',
                'slug' => 'customers.view',
                'module' => 'Customers',
                'description' => 'View Customers',
            ],
            [
                'name' => 'Create Customers',
                'slug' => 'customers.create',
                'module' => 'Customers',
                'description' => 'Create Customers',
            ],
            [
                'name' => 'Update Customers',
                'slug' => 'customers.update',
                'module' => 'Customers',
                'description' => 'Update Customers',
            ],
            [
                'name' => 'Delete Customers',
                'slug' => 'customers.delete',
                'module' => 'Customers',
                'description' => 'Deactivate Customers',
            ],

            // Vendors
            [
                'name' => 'View Vendors',
                'slug' => 'vendors.view',
                'module' => 'Vendors',
                'description' => 'View Vendors',
            ],
            [
                'name' => 'Create Vendors',
                'slug' => 'vendors.create',
                'module' => 'Vendors',
                'description' => 'Create Vendors',
            ],
            [
                'name' => 'Update Vendors',
                'slug' => 'vendors.update',
                'module' => 'Vendors',
                'description' => 'Update Vendors',
            ],
            [
                'name' => 'Delete Vendors',
                'slug' => 'vendors.delete',
                'module' => 'Vendors',
                'description' => 'Deactivate Vendors',
            ],

            // Companies
            [
                'name' => 'View Companies',
                'slug' => 'companies.view',
                'module' => 'Companies',
                'description' => 'View Companies',
            ],
            [
                'name' => 'Create Companies',
                'slug' => 'companies.create',
                'module' => 'Companies',
                'description' => 'Create Companies',
            ],
            [
                'name' => 'Update Companies',
                'slug' => 'companies.update',
                'module' => 'Companies',
                'description' => 'Update Companies',
            ],
            [
                'name' => 'Delete Companies',
                'slug' => 'companies.delete',
                'module' => 'Companies',
                'description' => 'Deactivate Companies',
            ],

            // Products
            [
                'name' => 'View Products',
                'slug' => 'products.view',
                'module' => 'Products',
                'description' => 'View Products',
            ],
            [
                'name' => 'Create Products',
                'slug' => 'products.create',
                'module' => 'Products',
                'description' => 'Create Products',
            ],
            [
                'name' => 'Update Products',
                'slug' => 'products.update',
                'module' => 'Products',
                'description' => 'Update Products',
            ],
            [
                'name' => 'Delete Products',
                'slug' => 'products.delete',
                'module' => 'Products',
                'description' => 'Deactivate Products',
            ],

            // Items
            [
                'name' => 'View Items',
                'slug' => 'items.view',
                'module' => 'Items',
                'description' => 'View Items',
            ],
            [
                'name' => 'Create Items',
                'slug' => 'items.create',
                'module' => 'Items',
                'description' => 'Create Items',
            ],
            [
                'name' => 'Update Items',
                'slug' => 'items.update',
                'module' => 'Items',
                'description' => 'Update Items',
            ],
            [
                'name' => 'Delete Items',
                'slug' => 'items.delete',
                'module' => 'Items',
                'description' => 'Deactivate Items',
            ],

            // Stock
            [
                'name' => 'View Stock',
                'slug' => 'stock.view',
                'module' => 'Stock',
                'description' => 'View Stock',
            ],
            [
                'name' => 'Create Stock',
                'slug' => 'stock.create',
                'module' => 'Stock',
                'description' => 'Create Stock',
            ],
            [
                'name' => 'Update Stock',
                'slug' => 'stock.update',
                'module' => 'Stock',
                'description' => 'Update Stock',
            ],
            [
                'name' => 'Delete Stock',
                'slug' => 'stock.delete',
                'module' => 'Stock',
                'description' => 'Deactivate Stock',
            ],

            // Purchase
            [
                'name' => 'View Purchases',
                'slug' => 'purchases.view',
                'module' => 'Purchases',
                'description' => 'View Purchases',
            ],
            [
                'name' => 'Create Purchases',
                'slug' => 'purchases.create',
                'module' => 'Purchases',
                'description' => 'Create Purchases',
            ],
            [
                'name' => 'Update Purchases',
                'slug' => 'purchases.update',
                'module' => 'Purchases',
                'description' => 'Update Purchases',
            ],
            [
                'name' => 'Delete Purchases',
                'slug' => 'purchases.delete',
                'module' => 'Purchases',
                'description' => 'Deactivate Purchases',
            ],
            [
                'name' => 'Purchase Return',
                'slug' => 'purchase.return',
                'module' => 'Purchase',
                'description' => 'Create purchase returns',
            ],

            // Sales
            [
                'name' => 'View Sales',
                'slug' => 'sales.view',
                'module' => 'Sales',
                'description' => 'View Sales',
            ],
            [
                'name' => 'Create Sales',
                'slug' => 'sales.create',
                'module' => 'Sales',
                'description' => 'Create Sales',
            ],
            [
                'name' => 'Update Sales',
                'slug' => 'sales.update',
                'module' => 'Sales',
                'description' => 'Update Sales',
            ],
            [
                'name' => 'Cancel Sales',
                'slug' => 'sales.cancel',
                'module' => 'Sales',
                'description' => 'Cancel sales invoices',
            ],
            [
                'name' => 'Sales Return',
                'slug' => 'sales.return',
                'module' => 'Sales',
                'description' => 'Create sales returns',
            ],

            // Quotes
            [
                'name' => 'View Quotes',
                'slug' => 'quotes.view',
                'module' => 'Quotes',
                'description' => 'View Quotes',
            ],
            [
                'name' => 'Create Quotes',
                'slug' => 'quotes.create',
                'module' => 'Quotes',
                'description' => 'Create Quotes',
            ],
            [
                'name' => 'Update Quotes',
                'slug' => 'quotes.update',
                'module' => 'Quotes',
                'description' => 'Update Quotes',
            ],
            [
                'name' => 'Delete Quotes',
                'slug' => 'quotes.delete',
                'module' => 'Quotes',
                'description' => 'Deactivate Quotes',
            ],
            [
                'name' => 'Convert Quotes',
                'slug' => 'quotes.convert',
                'module' => 'Quotes',
                'description' => 'Convert Quotes to Invoices',
            ],

            // Reports
            [
                'name' => 'View Reports',
                'slug' => 'reports.view',
                'module' => 'Reports',
                'description' => 'View reports',
            ],
            [
                'name' => 'Export Reports',
                'slug' => 'reports.export',
                'module' => 'Reports',
                'description' => 'Export reports',
            ],

            // Users
            [
                'name' => 'View Users',
                'slug' => 'users.view',
                'module' => 'Users',
                'description' => 'View users',
            ],
            [
                'name' => 'Create Users',
                'slug' => 'users.create',
                'module' => 'Users',
                'description' => 'Create users',
            ],
            [
                'name' => 'Update Users',
                'slug' => 'users.update',
                'module' => 'Users',
                'description' => 'Update users',
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'users.delete',
                'module' => 'Users',
                'description' => 'Deactivate users',
            ],

            // Settings
            [
                'name' => 'View Settings',
                'slug' => 'settings.view',
                'module' => 'Settings',
                'description' => 'View settings',
            ],
            [
                'name' => 'Update Settings',
                'slug' => 'settings.update',
                'module' => 'Settings',
                'description' => 'Update settings',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'slug' => $permission['slug'],
            ], $permission);
        }
    }
}
