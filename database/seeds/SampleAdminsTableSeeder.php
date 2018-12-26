<?php

use Illuminate\Database\Seeder;

use App\Admin;

class SampleAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admins = [
        	[
		        'firstname' => 'Admin',
		        'lastname' => 'PRAXXYS',
		        'email' => 'admin@praxxys.ph',
		        'email_verified_at' => now(),
		        'password' => '$2y$10$KDigvlqpSELK7OiGEjqGlu.bb1rLaHvB3OHZGvV3EuoDq5HslMO0i', // password
		        'remember_token' => str_random(10),
		    ],
            [
                'firstname' => 'Glenn',
                'lastname' => 'Baquero',
                'email' => 'glenn@praxxys.ph',
                'email_verified_at' => now(),
                'password' => '$2y$10$KDigvlqpSELK7OiGEjqGlu.bb1rLaHvB3OHZGvV3EuoDq5HslMO0i', // password
                'remember_token' => str_random(10),
            ],
        ];

    	foreach ($admins as $admin) {
    		$exist = Admin::where('email', $admin['email'])->first();
    		if (!$exist) {
	        	Admin::create($admin);
    		}
        }

     //    factory(Admin::class, 10)->create();
    }
}
