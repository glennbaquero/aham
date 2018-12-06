<?php

use Illuminate\Database\Seeder;

use App\RepairMan;
class SampleRepairMenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('repair_men')->delete();
        // factory(RepairMan::class, 20)->create();
    }
}
