<?php

use Illuminate\Database\Seeder;
use App\ProductTag;

class SampleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_tags')->delete();
        ProductTag::create(['name' => 'Featured Product']);
    }
}
