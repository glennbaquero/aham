<?php

use Illuminate\Database\Seeder;

use App\ContactUs;

class SampleContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
        	[
        		'contact' => '376 2287-90',
	    		'type' => 1
        	],
        	[
        		'contact' => '351-2269',
	    		'type' => 1
        	],
        	[
        		'contact' => '351-2267',
	    		'type' => 0
        	],
        ];

        foreach($contacts as $contact) {
        	ContactUs::create($contact);
        }
    }
}
