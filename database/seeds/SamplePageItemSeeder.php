<?php

use Illuminate\Database\Seeder;

use App\PageItem;

class SamplePageItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        
        if(($handle = fopen('database/csv/page_items.csv', "r")) !== FALSE){
        	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            	if ($row > 0) {
	                $this->command->info('writing row ' . $row . ' ' . $data[0]);

	                $item = new PageItem();
	                $item->page_id = $data[0];
                    $item->slug = $data[1];
	                $item->content = $data[2];
                    $item->type = $data[3];

	                $item->save();
            	}

                $row++;

            }
            fclose($handle);
        }
    }
}
