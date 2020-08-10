<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UpdateUserDetailsRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\BasicWarrantyRequest;

use App\Notifications\OneYearWarrantyNotificationToAdmin;
use App\Notifications\ExtendedWarrantyNotification;

use App\User;
use App\Admin;
use App\Invoice;
use App\InvoiceItem;
use App\Product;
use App\GlobalChecker;
use App\Helpers;

use Carbon\Carbon;

use Alert;

class UserController extends Controller
{
    public function verifyAccount($token)
    {
    	$user = User::whereEmailToken($token)->whereIsVerified(false)->first();

    	$user->is_verified = true;
        $user->email_verified_at = Carbon::now();

    	$user->save();

        alert()->success('Account is now activated!', 'Account is verified you can now use your account! Thank you!');

    	return redirect()->route('login');
    }

    public function fetchDetails()
    {
    	return response()->json([
    		'details' => auth()->user()
    	]);
    }

    public function update(UpdateUserDetailsRequest $request, $id)
    {
        User::find($id)->update($request->all());

        return response()->json([
            'response' => 'Success'
        ]);
    }

    public function updatepassword(UserChangePasswordRequest $request, $id)
    {

        $response;
        $user = User::find($id);

        if(Hash::check($request->input('old_password'), $user->password)){
            $user->update(['password' => Hash::make($request->input('password'))]);
            $response = 1;
        } else {
            $response = 404;
        }

        return response()->json([
            'response' => $response
        ]);
    }

    public function oneyearwarranty(BasicWarrantyRequest $request) 
    {
        $today = Carbon::today();
        $explode = explode('-',$today->toDateString());
        
        $path = $request->file('proof_purchase')->store('proof-purchase', 'public');

        $file_extension = explode('.', $path);
        
        $invoice = auth()->user()->invoices()->create([
            'serial_number' => $request->serial_number,
            'purchase_date' => $request->purchase_date,
            'proof_purchase' => $path,
            'application_number' => $request->application_number,
            'warranty_type' => 0,
            'contract_number' => $explode[0].$explode[1].$explode[2]. '-' .rand(100000000, 999999999),
            'file_extension' => $file_extension[1],
            'date_of_purchase' => Carbon::now(),
            'applied_date' => Carbon::now(),
            'expiration_date' => Carbon::now()->addYears(1),
            'reference_code' => $this->generateCode()
        ]);

        $invoice_item = Invoice::find($invoice);
        $product = Product::find($request->product_id);
        $invoice->invoice_items()->create([
            'product_id' => $request->product_id,
            'unit_price' => $product->extended_amount == null ? 0 : $product->extended_amount,
            'discount' => 0,
            'total_price' => $product->extended_amount == null ? 0 : $product->extended_amount,
        ]);


        $admins = Admin::where('type', 0)->get();
        foreach ($admins as $admin) {
            if($admin->hasAnyPermission(['admin.application.edit', 'admin.application.create', 'admin.application.destroy'])) {
                $admin->notify(new OneYearWarrantyNotificationToAdmin($admin->email));
            }
        }


        return response()->json([
            'message' => 1
        ]);
    }

    public function extendedwarranty(BasicWarrantyRequest $request)
    {
        $today = Carbon::today();
        $explode = explode('-',$today->toDateString());
        
        $path = $request->file('proof_purchase')->store('proof-purchase', 'public');

        $file_extension = explode('.', $path);
        
        $invoice = auth()->user()->invoices()->create([
            'serial_number' => $request->serial_number,
            'purchase_date' => $request->purchase_date,
            'proof_purchase' => $path,
            'application_number' => $request->application_number,
            'warranty_type' => 1,
            'contract_number' => $explode[0].$explode[1].$explode[2]. '-' .rand(100000000, 999999999),
            'file_extension' => $file_extension[1],
            'date_of_purchase' => Carbon::now(),
            'applied_date' => Carbon::now(),
            'expiration_date' => Carbon::now()->addYears(2),
            'reference_code' => $this->generateCode()
        ]);

        $invoice_item = Invoice::find($invoice);

        $product = Product::find($request->product_id);

        $invoiceitem = $invoice->invoice_items()->create([
            'product_id' => $request->product_id,
            'unit_price' => $product->extended_amount,
            'discount' => 0,
            'total_price' => $product->extended_amount,
            'status' => 2
        ]);


        $admins = Admin::where('type', 0)->get();
        foreach ($admins as $admin) {
            if($admin->hasAnyPermission(['admin.application.edit', 'admin.application.create', 'admin.application.destroy'])) {
                $admin->notify(new ExtendedWarrantyNotification($admin->email));
            }
        }

        return response()->json([
            'message' => 1,
            // 'redirect' => route('checkout', $invoiceitem->id)
        ]);
    }

    public function userproduct()
    {
        return view('public.pages.user-products-page');
    }

    public function generateCode($length = 10, $column = 'reference_code', $prefix = 'AHAM') {
        do{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charLength = strlen($characters);

            $randomString = null;

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charLength - 1)];
            }

            $isExisting = Invoice::where($column, $randomString)->first();
        } while ($isExisting);
        
        $code = $prefix;
        $code .= $randomString;

        return $code;
    }
}
