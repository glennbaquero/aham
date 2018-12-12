<?php

use Illuminate\Database\Seeder;

use App\CarouselTag;

class SampleCarouselTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CarouselTag::class, 10)->create();
    }
}
