<?php

use Illuminate\Database\Seeder;

use App\PermissionCategory;
use App\Permission;

class SamplePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = [
            [
                'name' => 'Products',
                'description' => 'Manage Products',
                'icon' => 'fa fa-boxes',
                'items' => [
                    [
                        'name' => 'admin.product.edit',
                        'label' => 'Edit Product',
                    ],
                    [
                        'name' => 'admin.product.create',
                        'label' => 'Add Product',
                    ],
                    [
                        'name' => 'admin.product.destroy',
                        'label' => 'Remove Product',
                    ],
                    [
                        'name' => 'admin.product.upload',
                        'label' => 'Upload Product',
                    ],
                ],
            ],
            [
                'name' => 'Application',
                'description' => 'Manage Customer Application',
                'icon' => 'fa fa-boxes',
                'items' => [
                    [
                        'name' => 'admin.application.edit',
                        'label' => 'Edit Application',
                    ],
                    [
                        'name' => 'admin.application.create',
                        'label' => 'Add Application',
                    ],
                    [
                        'name' => 'admin.application.destroy',
                        'label' => 'Remove Application',
                    ],
                ],
            ],
            [
                'name' => 'Repairs',
                'description' => 'Manage repair services request',
                'icon' => 'fa fa-wrench',
                'items' => [
                    [
                        'name' => 'admin.service.assign-repair',
                        'label' => 'Assign Repair Man'
                    ],
                    [
                        'name' => 'admin.service.approve',
                        'label' => 'Approve Warranty',
                    ],
                    [
                        'name' => 'admin.service.decline',
                        'label' => 'Decline Warranty',
                    ],
                ],
            ],
            [
                'name' => 'Repairs',
                'description' => 'Manage repair services request',
                'icon' => 'fa fa-wrench',
                'items' => [
                    [
                        'name' => 'admin.service.assign-repair',
                        'label' => 'Assign Repair Man'
                    ],
                    [
                        'name' => 'admin.service.approve',
                        'label' => 'Approve Warranty',
                    ],
                    [
                        'name' => 'admin.service.decline',
                        'label' => 'Decline Warranty',
                    ],
                ],
            ],
            [
                'name' => 'Content Management',
                'description' => 'Manage CMS',
                'icon' => 'fas fa-sitemap',
                'items' => [
                    [
                        'name' => 'admin.pages.create',
                        'label' => 'Adding new page'
                    ],
                    [
                        'name' => 'admin.pages.edit',
                        'label' => 'Editing page',
                    ],
                    [
                        'name' => 'admin.pages.destroy',
                        'label' => 'Removing of page',
                    ],
                    [
                        'name' => 'admin.carousel.create',
                        'label' => 'Adding new slide'
                    ],
                    [
                        'name' => 'admin.carousel.edit',
                        'label' => 'Editing slide',
                    ],
                    [
                        'name' => 'admin.carousel.destroy',
                        'label' => 'Removing of slide',
                    ],
                    [
                        'name' => 'admin.page-items.create',
                        'label' => 'Adding new content to the page',
                    ],
                    [
                        'name' => 'admin.page-items.edit',
                        'label' => 'Editing content to the page',
                    ],
                    [
                        'name' => 'admin.page-items.destroy',
                        'label' => 'Removing content to the page',
                    ],
                    [
                        'name' => 'admin.faqs.create',
                        'label' => 'Creating FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.edit',
                        'label' => 'Updating FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.destroy',
                        'label' => 'Removing FAQ',
                    ],
                    [
                        'name' => 'admin.contacts.create',
                        'label' => 'Creating Contact Information',
                    ],
                    [
                        'name' => 'admin.contacts.edit',
                        'label' => 'Updating Contact Information',
                    ],
                    [
                        'name' => 'admin.contacts.destroy',
                        'label' => 'Removing Contact Information',
                    ],
                ],
            ],
            [
                'name' => 'Discount',
                'description' => 'Manage Customer Discount',
                'icon' => 'fas fa-money-bill-alt',
                'items' => [
                    [
                        'name' => 'admin.discount.create',
                        'label' => 'Creating new Discount information'
                    ],
                    [
                        'name' => 'admin.discount.approve',
                        'label' => 'Updating Discount information',
                    ],
                    [
                        'name' => 'admin.discount.destroy',
                        'label' => 'Removing Discount information',
                    ],
                ],
            ],
            [
                'name' => 'Type',
                'description' => 'Manage Product Type',
                'icon' => 'fas fa-th-large',
                'items' => [
                    [
                        'name' => 'admin.types.create',
                        'label' => 'Creating new product type'
                    ],
                    [
                        'name' => 'admin.types.edit',
                        'label' => 'Updating product type',
                    ],
                    [
                        'name' => 'admin.types.destroy',
                        'label' => 'Removing product type',
                    ],
                ],
            ],
            [
                'name' => 'Category',
                'description' => 'Manage Product Category',
                'icon' => 'fas fa-archive',
                'items' => [
                    [
                        'name' => 'admin.categories.create',
                        'label' => 'Creating new product category'
                    ],
                    [
                        'name' => 'admin.categories.edit',
                        'label' => 'Updating product category',
                    ],
                    [
                        'name' => 'admin.categories.destroy',
                        'label' => 'Removing product category',
                    ],
                ],
            ],
            [
                'name' => 'Administrators',
                'description' => 'Manage Admin',
                'icon' => 'fas fa-user-shield',
                'items' => [
                    [
                        'name' => 'admin.administrator.edit',
                        'label' => 'Edit Administrator',
                    ],
                    [
                        'name' => 'admin.administrator.create',
                        'label' => 'Add Administrator',
                    ],
                    [
                        'name' => 'admin.administrator.destroy',
                        'label' => 'Remove Administrator',
                    ],
                ],
            ],
            [
                'name' => 'Users',
                'description' => 'Manage Users',
                'icon' => 'fa fa-users',
                'items' => [
                    [
                        'name' => 'admin.users.show',
                        'label' => 'View Users',
                    ],
                    [
                        'name' => 'admin.users.destroy',
                        'label' => 'Remove\Restore Users',
                    ],
                ],
            ],
            [
                'name' => 'Permission And Roles',
                'description' => 'Manage Permission and Roles',
                'icon' => 'fas fa-shield-alt',
                'items' => [
                    [
                        'name' => 'admin.roles.edit',
                        'label' => 'Edit Roles',
                    ],
                    [
                        'name' => 'admin.roles.create',
                        'label' => 'Add Roles',
                    ],
                    [
                        'name' => 'admin.roles.destroy',
                        'label' => 'Remove Roles',
                    ],
                ],
            ],
            [
                'name' => 'Logs',
                'description' => 'Viewing all activity in the system',
                'icon' => 'fa fa-clipboard-list',
                'items' => [
                    [
                        'name' => 'admin.activity-logs.index',
                        'label' => 'View Activity Logs',
                    ],
                ],
            ],
        ];

    	foreach ($categories as $category) {
            $permissions = $category;
            unset($category['items']);

            $item = PermissionCategory::where('name', $category['name'])->first();

            if (!$item) {
                $this->command->info('Adding permission category ' . $category['name'] . '...');
                $item = PermissionCategory::create($category);
            } else {
                $this->command->warn('Updating permission category ' . $category['name'] . '...');
                $item->update($category);
            }


            foreach ($permissions['items'] as $permission) {
                $permission['guard_name'] = 'admin';

                $permissionItem = Permission::where('name', $permission['name'])->first();
                
                if (!$permissionItem) {
                    $this->command->info('Adding permission ' . $permission['name'] . '...');
                    $item->permissions()->create($permission);
                } else {
                    $this->command->warn('Updating permission ' . $permission['name'] . '...');
                    unset($permission['name']);
                    $permissionItem->update($permission);
                }

            }
    	}

    }
}
