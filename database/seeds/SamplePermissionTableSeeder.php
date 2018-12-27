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
                        'name' => 'admin.products.index',
                        'label' => 'Showing All Product',
                    ],
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
                        'name' => 'admin.application',
                        'label' => 'Showing All Application',
                    ],
                    [
                        'name' => 'admin.application.approve',
                        'label' => 'Edit Application',
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
                        'name' => 'admin.request',
                        'label' => 'Showing All Repair Request',
                    ],
                    [
                        'name' => 'admin.request.create',
                        'label' => 'Creating Request',
                    ],
                    [
                        'name' => 'admin.request.edit',
                        'label' => 'Edit Request',
                    ],
                    [
                        'name' => 'admin.request.destroy',
                        'label' => 'Destroy Request',
                    ],
                ],
            ],
            [
                'name' => 'Content Management',
                'description' => 'Manage CMS',
                'icon' => 'fas fa-sitemap',
                'items' => [
                    [
                        'name' => 'admin.pages.index',
                        'label' => 'Showing All Pages',
                    ],
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
                        'name' => 'admin.page-items.index',
                        'label' => 'Showing All Page Items',
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
                ],
            ],
            [
                'name' => 'Image Slider',
                'description' => 'Manage image slider most likely image slider for banner',
                'icon' => 'fas fa-images',
                'items' => [
                    [
                        'name' => 'admin.carousel.index',
                        'label' => 'Showing All Image Slider',
                    ],
                    [
                        'name' => 'admin.carousel.create',
                        'label' => 'Add new slide'
                    ],
                    [
                        'name' => 'admin.carousel.edit',
                        'label' => 'Edit slide',
                    ],
                    [
                        'name' => 'admin.carousel.destroy',
                        'label' => 'Destroy of slide',
                    ],
                ],
            ],
            [
                'name' => 'Contact Information',
                'description' => 'Manage contact information',
                'icon' => 'fas fa-phone',
                'items' => [
                    [
                        'name' => 'admin.contacts.index',
                        'label' => 'Showing All Contact Information',
                    ],
                    [
                        'name' => 'admin.contacts.create',
                        'label' => 'Add Contact Information',
                    ],
                    [
                        'name' => 'admin.contacts.edit',
                        'label' => 'Edit Contact Information',
                    ],
                    [
                        'name' => 'admin.contacts.destroy',
                        'label' => 'Destroy Contact Information',
                    ],
                ],
            ],
            [
                'name' => 'Frequently Ask Question',
                'description' => 'Manage FAQ',
                'icon' => 'fas fa-question',
                'items' => [
                    [
                        'name' => 'admin.faqs.index',
                        'label' => 'Showing All FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.create',
                        'label' => 'Add FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.edit',
                        'label' => 'Edit FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.destroy',
                        'label' => 'Destroy FAQ',
                    ],
                ],
            ],
            [
                'name' => 'Location',
                'description' => 'Manage Location',
                'icon' => 'fas fa-question',
                'items' => [
                    [
                        'name' => 'admin.locations.index',
                        'label' => 'Showing All Location',
                    ],
                    [
                        'name' => 'admin.locations.create',
                        'label' => 'Add Location',
                    ],
                    [
                        'name' => 'admin.locations.edit',
                        'label' => 'Edit Location',
                    ],
                    [
                        'name' => 'admin.locations.destroy',
                        'label' => 'Destroy Location',
                    ],
                ],
            ],
            [
                'name' => 'Discount',
                'description' => 'Manage Customer Discount',
                'icon' => 'fas fa-money-bill-alt',
                'items' => [
                    [
                        'name' => 'admin.discounts',
                        'label' => 'Showing All Discount',
                    ],
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
                        'name' => 'admin.types.index',
                        'label' => 'Showing All Product Type',
                    ],
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
                        'name' => 'admin.categories.index',
                        'label' => 'Showing All Product Categories',
                    ],
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
                        'name' => 'admin.administrator',
                        'label' => 'Showing All Admin',
                    ],
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
                        'name' => 'admin.users.index',
                        'label' => 'Showing All Users',
                    ],
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
                        'name' => 'admin.roles',
                        'label' => 'Showing All Roles',
                    ],
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
