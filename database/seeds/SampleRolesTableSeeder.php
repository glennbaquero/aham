<?php

use Illuminate\Database\Seeder;

use App\Role;

class SampleRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = [
        	[
                'name' => 'Repair Man',
		        'guard_name' => 'admin',
		    ],
            [
                'name' => 'Super Admin',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'Regular Admin',
                'guard_name' => 'admin',
            ],
        ];

    	foreach ($roles as $role) {
    		$exist = Role::where('name', $role['name'])->first();
    		if (!$exist) {
	        	Role::create($role);
    		}
        }

        // factory(Role::class, 10)->create();
    }
}
