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
        $this->call(SampleCategorySeeder::class);
        $this->call(SampleTypeSeeder::class);
        $this->call(SampleAdminsTableSeeder::class);
        $this->call(SamplePageSeeder::class);
        $this->call(SamplePageItemSeeder::class);
        $this->call(SampleCategorySeeder::class);
        $this->call(SampleCarouselTagsSeeder::class);
        $this->call(SampleTagSeeder::class);
        $this->call(SampleTypeSeeder::class);
        $this->call(SampleProductSeeder::class);
        $this->call(SampleUsersTableSeeder::class);
        $this->call(SampleRolesTableSeeder::class);
        $this->call(SamplePermissionTableSeeder::class);
        $this->call(SampleInvoicesTableSeeder::class);
    }
}
