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
        factory(Product::class, 50)->create();
    }
}
