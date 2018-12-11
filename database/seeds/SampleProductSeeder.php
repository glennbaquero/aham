<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\ProductImage;

class SampleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();
        \DB::table('product_images')->delete();

        factory(Product::class, 30)->create()->each(function($item) {
            $item->images()->saveMany(factory(ProductImage::class, 3)->create());
        });
    }
}
