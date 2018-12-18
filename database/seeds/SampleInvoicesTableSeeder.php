<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Invoice;
use App\InvoiceItem;

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
    		$user->invoices()->saveMany(factory(Invoice::class, 1)->create()->each(function($invoice) {
    			$invoice->invoice_items()->saveMany(factory(InvoiceItem::class, 3)->create());
    		}));
    	}
        
    }
}
