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
        // $this->call(SampleCategorySeeder::class);
        // $this->call(SampleTypeSeeder::class);
        $this->call(SampleCategorySeeder::class);
        $this->call(SampleTypeSeeder::class);
        $this->call(SampleProductSeeder::class);
        $this->call(SampleUsersTableSeeder::class);
        $this->call(SampleRepairMenTableSeeder::class);
    }
}
