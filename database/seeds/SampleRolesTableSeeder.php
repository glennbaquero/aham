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
        \DB::table('roles')->delete();
        factory(Role::class, 50)->create();
    }
}
