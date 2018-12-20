<?php

use Illuminate\Database\Seeder;

class SampleLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Location::class, 10)->create();
    }
}
