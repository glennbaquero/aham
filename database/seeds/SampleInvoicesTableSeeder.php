<?php

use Illuminate\Database\Seeder;

use App\User;

class SampleInvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = User::all();   

    	foreach ($users as $user) {
    		$user->invoices()->saveMany(factory(App\Invoice::class, 1)->create()->each(function($invoice) {
    			$invoice->invoice_items()->saveMany(factory(App\InvoiceItem::class, 3)->create());
    		}));
    	}
    }
}
