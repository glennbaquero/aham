<?php

use Illuminate\Database\Seeder;

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
        \DB::table('permissions')->delete();
    	$permissions = [
    		[
                'name' => 'Edit Product',
    			'guard_name' => 'admin',
    		],
    		[
    			'name' => 'Add Product',
                'guard_name' => 'admin',
    		],
    		[
    			'name' => 'Remove Product',
                'guard_name' => 'admin',
    		],
    	];

    	foreach ($permissions as $permission) {
	        Permission::create($permission);
    	}

    }
}
