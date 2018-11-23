<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SampleAdminsTableSeeder::class);
        $this->call(SampleRolesTableSeeder::class);
        $this->call(SamplePermissionTableSeeder::class);
        $this->call(SampleCarouselTagsSeeder::class);
        $this->call(SampleCategorySeeder::class);
        $this->call(SampleTypeSeeder::class);
    }
}
