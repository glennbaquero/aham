<?php

use Illuminate\Database\Seeder;

use App\Page;

class SamplePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/pages.csv', "r")) !== FALSE){
        	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            	if ($row > 0) {
	                $this->command->info('writing row ' . $row . ' ' . $data[0]);

	                $item = new Page();
	                $item->name = $data[0];
                    $item->slug = $data[1];

	                $item->save();
            	}

                $row++;

            }
            fclose($handle);
        }
    }
}
