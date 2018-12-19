<?php

namespace App\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// use App\Notifications\UserPaid;
// use App\Notifications\InvoicePaid;

use App\Invoice;
use App\User;
use App\InvoiceItem;

class iPayProcessor
{
    public  $code;
    public  $url;
    private $key;
    public $details;
    public $backend_url;
    public $return_url;

    public  $amount;
    public  $reference_code;
    public  $currency;
    public  $paymentId;
    private $warranty_type;
    public  $signature;

    protected $invoice;

    public function __construct() {
        $this->key = config('ecommerce.ipay88.key');
        $this->code = config('ecommerce.ipay88.code');
    }

    public function process(Invoice $invoice)
    {
        $this->setConfig();
        $this->invoice = Invoice::find($invoice->id);
        $this->setSignatureData();
    }

    public function callback(Request $request)
    {
        $action = false;

        $this->getResponseVars($request);
        $this->getInvoice();

        if($this->checkResponse()) {
            $this->processInvoice();
            // $this->notifyAdmin();
            // $this->notifyUser();

            $action = 'RECEIVEOK';
        }

        return $action;
    }

    private function setConfig() {
        $this->details = config('app.name');
        $this->url = config('ecommerce.ipay88.gateway');
        $this->backend_url = secure_url(route('ipay.process'));
        $this->return_url = secure_url(route('ipay.return'));
    }

    private function setSignatureData() {
        $this->amount = $this->invoice->renderTotal();
        $this->currency = 'PHP';
        $this->reference_code = $this->invoice->contract_number;
        // $this->paymentId =  1;

        Log::info($this->invoice->renderRawTotal());

        $this->signature = $this->buildSignature($this->amount, $this->currency, $this->reference_code);

    }

    private function buildSignature($amount, $currency, $reference, $warranty_type = null, $paymentId = null) {

        Log::info('signature build string: ' . $this->key . $this->code . $reference . (floatval($amount) * 100) . $currency . $warranty_type);

        return base64_encode(hex2bin(sha1(
            $this->key . $this->code . $paymentId . $reference . (floatval($amount) * 100) . $currency . $warranty_type
        )));
    }

    private function getResponseVars($request) {
        $this->contract_number = $request->input('RefNo');
        $this->warranty_type = $request->input('Status');
        $this->signature = $request->input('Signature');
        $this->paymentId = $request->input('PaymentId');
    }

    private function getInvoice() {
        $query = [
            'contract_number' => $this->contract_number,
            'warranty_type' => Invoice::BASIC,
        ];

        $this->invoice = Invoice::where($query)->first();
    }

    private function checkResponse()
    {
        $action = false;

        if ($this->invoice) {
            $expectedSignature = $this->buildSignature(
                $this->invoice->renderTotal(),
                // $this->invoice->currency_code,
                $this->invoice->contract_number,
                $this->warranty_type,
                $this->paymentId
            );

            Log::info('expected signature: ' . $expectedSignature);
            Log::info('received signature: ' . $this->signature);

            $action = $expectedSignature === $this->signature;
        }

        return $action;
    }

    private function processInvoice() {

        \DB::beginTransaction();

        $this->invoice->warranty_type = Invoice::EXTENDED;
        $this->invoice->save();

        \DB::commit();


    }

    private function notifyUser()
    {
        // $this->invoice->user->notify(new UserPaid($this->invoice));
    }

    private function notifyAdmin()
    {
        // $admins = Helpers::getNotifiableAdmins('invoices');

        // foreach ($admins as $admin) {
        //     $admin->notify(new InvoicePaid($this->invoice));

        // }
    }

}
