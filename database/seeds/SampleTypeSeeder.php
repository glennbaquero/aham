<?php

use Illuminate\Database\Seeder;

use App\Type;

class SampleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('types')->delete();
        factory(Type::class, 10)->create();
    }
}
