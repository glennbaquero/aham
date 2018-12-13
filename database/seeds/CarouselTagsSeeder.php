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
        $tags = [
            [
                'name' => 'about'
            ],
            [
                'name' => 'strategic partners'
            ],
            [
                'name' => 'product'
            ],
            [
                'name' => 'warranty'
            ]
        ];

        foreach ($tags as $tag) {
            CarouselTag::create($tag);
        }
    }
}
