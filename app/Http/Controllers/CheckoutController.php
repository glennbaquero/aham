<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use App\Ecommerce\iPayProcessor;

use Carbon\Carbon;
use App\Invoice;
use App\InvoiceItem;
use Alert;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request) 
    {
        $gateway = false;
        $message = false;
        $redirectUrl = false;

        $invoice = Invoice::find($request->invoice_id);
        
        $item = $invoice->invoice_items()->update($request->only(['total_price', 'discount']));
        
        switch ($request->input('payment_method')) {
            case Invoice::GATEWAY_IPAY:
                    $gateway = new iPayProcessor;
                    $gateway->process($invoice);
                break;
        }


        return response()->json([
            'invoice' => $invoice,
            'gateway' => $gateway,
            'message' => $message,
            'user' => $invoice->user,
            'redirectUrl' => $redirectUrl,
        ]);
    }

    /**
     * @iPay88: Callback 
     */
    public function ipayProcess(Request $request)
    {
        Log::info('Running ' . __function__);
        Log::info($request);

        $processor = new iPayProcessor();

        return $processor->callback($request);
    }

    /**
     * @iPay88: Return 
     */
    public function ipayReturn(Request $request)
    {
        Log::info('Running ' . __function__);
        Log::info($request);

    // Helpers::flash($request->input('ErrDesc'), 'iPay88 Error', 'error');

        if($request->input('Status') == 1) {
            // Helpers::flash('Thank you for your order! You will receive a confirmation via email shortly.');
        }

        return redirect('/');
    }

}
