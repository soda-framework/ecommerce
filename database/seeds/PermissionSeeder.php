<?php

namespace Soda\Ecommerce\Seeds;

use Soda\Cms\Models\Role;
use Illuminate\Database\Seeder;
use Soda\Cms\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role_store_admin = Role::create([
            'name'         => 'store_admin',
            'display_name' => 'Store Admin',
            'description'  => 'Store Admins can create stores and manage the system globally',
        ]);

        $role_store_moderator = Role::create([
            'name'         => 'store_moderator',
            'display_name' => 'Store Moderator',
            'description'  => 'Store Moderators can manage stores globally',
        ]);

        $role_inventory_manager = Role::create([
            'name'         => 'inventory_manager',
            'display_name' => 'Inventory Manager',
            'description'  => 'Inventory Managers are able to manage product lines',
        ]);

        $role_store_manager = Role::create([
            'name'         => 'store_manager',
            'display_name' => 'Store Manager',
            'description'  => 'Store Managers are able to manage store inventory',
        ]);

        $role_store_assistant = Role::create([
            'name'         => 'store_assistant',
            'display_name' => 'Store Assistant',
            'description'  => 'Store Assitants are able to manage store orders.',
        ]);

        $permission_manage_products = Permission::create([
            'name'         => 'manage-products',
            'display_name' => 'Manage Products',
            'description'  => 'Manage product ranging.',
        ]);

        $permission_view_store_products = Permission::create([
            'name'         => 'view-store-products',
            'display_name' => 'View Store Products',
            'description'  => 'View products for a store.',
        ]);

        $permission_update_store_products = Permission::create([
            'name'         => 'update-store-products',
            'display_name' => 'Update Store Products',
            'description'  => 'Update products for a store.',
        ]);

        $permission_update_store_product_pricing = Permission::create([
            'name'         => 'update-store-product-pricing',
            'display_name' => 'Update Store Product Pricing',
            'description'  => 'Update pricing for products in a store.',
        ]);

        $permission_add_store_products = Permission::create([
            'name'         => 'add-store-products',
            'display_name' => 'Add Store Products',
            'description'  => 'Add products to a store.',
        ]);

        $permission_remove_store_products = Permission::create([
            'name'         => 'remove-store-products',
            'display_name' => 'Remove Store Products',
            'description'  => 'Remove products from a store.',
        ]);

        $permission_view_store_customers = Permission::create([
            'name'         => 'view-store-customers',
            'display_name' => 'View Store Customers',
            'description'  => 'View list of customers associated with a store.',
        ]);

        $permission_manage_store_customers = Permission::create([
            'name'         => 'manage-store-customers',
            'display_name' => 'Manage Store Customers',
            'description'  => 'Manage customers associated with a store.',
        ]);

        $permission_view_store_orders = Permission::create([
            'name'         => 'view-store-orders',
            'display_name' => 'View Store Orders',
            'description'  => 'View list of orders associated with a store.',
        ]);

        $permission_manage_store_orders = Permission::create([
            'name'         => 'manage-store-orders',
            'display_name' => 'Manage Store Orders',
            'description'  => 'Manage orders associated with a store.',
        ]);

        $permission_update_store_details = Permission::create([
            'name'         => 'update-store-details',
            'display_name' => 'Update Store Details',
            'description'  => 'Update details for store.',
        ]);

        $permission_administrate_stores = Permission::create([
            'name'         => 'administrate-stores',
            'display_name' => 'Administrate Stores',
            'description'  => 'Administrate stores for all applications.',
        ]);

        $permission_moderate_stores = Permission::create([
            'name'         => 'moderate-stores',
            'display_name' => 'Moderate Stores',
            'description'  => 'Manage all stores for application.',
        ]);

        $role_store_admin->attachPermissions([
            $permission_administrate_stores,
            $permission_moderate_stores,
        ]);

        $role_store_moderator->attachPermissions([
            $permission_moderate_stores,
        ]);

        $role_inventory_manager->attachPermissions([
            $permission_manage_products,
        ]);

        $role_store_manager->attachPermissions([
            $permission_view_store_customers,
            $permission_manage_store_customers,
            $permission_view_store_products,
            $permission_update_store_products,
            $permission_update_store_product_pricing,
            $permission_add_store_products,
            $permission_remove_store_products,
            $permission_view_store_orders,
            $permission_manage_store_orders,
            $permission_update_store_details,
        ]);

        $role_store_assistant->attachPermissions([
            $permission_view_store_customers,
            $permission_view_store_products,
            $permission_view_store_orders,
            $permission_manage_store_orders,
            $permission_update_store_details,
        ]);
    }
}
