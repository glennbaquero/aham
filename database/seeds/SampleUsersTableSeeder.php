<?php

use Illuminate\Database\Seeder;


use App\UserDetail;
use App\User;
use App\Invoice;
use App\InvoiceItem;

class SampleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_details')->delete();
        \DB::table('users')->delete();
        \DB::table('invoices')->delete();
        \DB::table('invoice_items')->delete();

        factory(User::class, 50)->create();
        // factory(UserDetail::class, 50)->create();
        factory(Invoice::class, 50)->create();
        factory(InvoiceItem::class, 50)->create();
    }
}
