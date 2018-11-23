<?php

use Illuminate\Database\Seeder;


use App\UserDetail;
use App\User;
use App\UserProduct;

class SampleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_details')->delete();
        \DB::table('users')->delete();
        \DB::table('user_products')->delete();

        factory(User::class, 50)->create();
        factory(UserDetail::class, 50)->create();
        factory(UserProduct::class, 50)->create();
    }
}
