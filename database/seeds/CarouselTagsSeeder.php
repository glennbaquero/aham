<?php

use Illuminate\Database\Seeder;

use App\CarouselTag;

class CarouselTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('carousel_tags')->delete();
        factory(CarouselTag::class, 10)->create();
    }
}
