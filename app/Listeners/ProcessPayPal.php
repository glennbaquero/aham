<?php

namespace App\Listeners;

use PRAXXYSEcommerce\PayPal\Events\PayPalNotified;
use Illuminate\Support\Facades\Log;

use App\Invoice;
use App\User;
use App\Admin;
use App\Helpers;

use App\Notifications\InvoicePaid;
use App\Notifications\UserPaid;

class ProcessPayPal
{

    protected $result;

    /**
     * Handle the event.
     *
     * @param  \PRAXXYSEcommerce\PayPal\Events\PayPalNotified  $event
     * @return void
     */
    public function handle(PayPalNotified $event)
    {

        Log::info('Dispatching PayPalNotified...');

        # dd($event->result):
        # [
        #   "reference_code" => "(your invoice reference)",
        #   "transaction_code" => "Transaction code from PayPal",
        # ]
        $this->result = $event->result;

        # PROCESS YOUR ACTIONS HERE:
        
        $this->processInvoice();
        $this->notifyUser();
        $this->notifyAdmin();
    }


    /* * * * * * * * * * * * * * *
     * SAMPLE CODE FOR REFERENCE *
     * * * * * * * * * * * * * * */


    private function processInvoice() {

        \DB::beginTransaction();

        # will cause error if no code is there
        $this->invoice = Invoice::where('reference_code', $this->result['reference_code'])->first();
        $this->invoice->payment_gateway_code = $this->result['transaction_code'];

        $this->invoice->warranty_type = Invoice::EXTENDED;

        if($this->invoice->has_notified){
            $this->invoice->date_of_purchase = Carbon::now();
            $this->invoice->applied_date = Carbon::now();
            $this->invoice->expiration_date = Carbon::now()->addYears(2);
            $this->invoice->has_notified = false;
        }
        
        $this->invoice->save();


        foreach ($this->invoice->invoice_items as $key => $item) {
            $item->update(['status' => 5]);
        }

        \DB::commit();

    }

    private function notifyUser()
    {
        $this->invoice->user->notify(new UserPaid($this->invoice));
    }

    private function notifyAdmin()
    {
        $admins = Helpers::getNotifiableAdmins('admin.application');

        foreach ($admins as $admin)
        {
            $admin->notify(new InvoicePaid($this->invoice));
        }
    }


}