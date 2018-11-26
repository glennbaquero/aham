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
