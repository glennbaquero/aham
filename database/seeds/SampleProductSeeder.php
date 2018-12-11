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

        $products = [
        	[
        		'category_id' => 1,
        		'type_id' => 1,
        		'model' => 'ASSC123',
        		'name' => 'COOKING MACHINE',
        		'description' => 'none',
        		'specification' => 'none',
        		'extended_amount' => '1200.00',
        		'image' => [
        			'product_image' => 'product/njCLJlWlXDnNk6S0ExP2Hl74VtTZ0NmmYTetjvZC.jpeg'
        		]
        	],
        	[
        		'category_id' => 1,
        		'type_id' => 2,
        		'model' => 'XCC444',
        		'name' => 'IRON MACHINE',
        		'description' => 'none',
        		'specification' => 'none',
        		'extended_amount' => '1200.00',
        		'image' => [
        			'product_image' => 'product-images/de7R4KF3WaoDZH72fQJstrYb3W1c3xyjy7mAkIWb.jpeg'
        		]
        	],
        	[
        		'category_id' => 2,
        		'type_id' => 1,
        		'model' => 'IM2334',
        		'name' => 'IRON MAN',
        		'description' => 'none',
        		'specification' => 'none',
        		'extended_amount' => '1200.00',
        		'image' => [
        			'product_image' => 'product/DtU9X99Ht3zGsyvNBq1UOCQiWOfceid9pVDVM5O0.jpeg'
        		]
        	],
        	[
        		'category_id' => 2,
        		'type_id' => 3,
        		'model' => 'ASSC123',
        		'name' => 'WAR MACHINE',
        		'description' => 'none',
        		'specification' => 'none',
        		'extended_amount' => '1200.00',
        		'image' => [
        			'product_image' => 'product-images/de7R4KF3WaoDZH72fQJstrYb3W1c3xyjy7mAkIWb.jpeg'
        		]
        	],
        ];


        foreach ($products as $product) {
        	$data = Product::create([
        		'category_id' => $product['category_id'],
        		'type_id' => $product['type_id'],
        		'model' => $product['model'],
        		'name' => $product['name'],
        		'description' => $product['description'],
        		'specification' => $product['specification'],
        		'extended_amount' => $product['extended_amount']
        	]);

        	foreach($product['image'] as $image) {
        		ProductImage::create([
        			'product_id' => $data->id,
        			'image' => $image
        		]);
        	}
        }
    }
}
