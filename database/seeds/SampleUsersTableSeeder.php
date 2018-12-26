<?php

use Illuminate\Database\Seeder;


use App\UserDetail;
use App\User;
use App\Invoice;
use App\InvoiceItem;

class SampleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = [
            [
                'firstname' => 'Glenn',
                'lastname' => 'Baquero',
                'email' => 'glenn@praxxys.ph',
                'email_verified_at' => now(),
                'is_verified' => 1,
                'birthday' => '2017-10-02',
                'contact' => '1-602-979-2685',
                'address' => '3770 Brown Ford Apt. 590 East Earnestineburgh, MT 41856',
                'password' => '$2y$10$KDigvlqpSELK7OiGEjqGlu.bb1rLaHvB3OHZGvV3EuoDq5HslMO0i', // password
                'remember_token' => str_random(10),
            ],
        ];

        foreach ($users as $user) {
            $exist = User::where('email', $user['email'])->first();
            if (!$exist) {
                User::create($user);
            }
        }


        factory(User::class, 3)->create();
    }
}
