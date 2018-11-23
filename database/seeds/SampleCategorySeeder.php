<?php

use Illuminate\Database\Seeder;

use App\Category;

class SampleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();
        factory(Category::class, 10)->create();
    }
}
