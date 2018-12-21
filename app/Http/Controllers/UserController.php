<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UpdateUserDetailsRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\BasicWarrantyRequest;

use App\Notifications\OneYearWarrantyNotificationToAdmin;

use App\User;
use App\Admin;
use App\Invoice;
use App\InvoiceItem;
use App\Product;

use Carbon\Carbon;

use Alert;

class UserController extends Controller
{
    public function verifyAccount($token)
    {
    	$user = User::whereEmailToken($token)->whereIsVerified(false)->first();

    	$user->is_verified = true;

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

        // dd( $explode[0].$explode[1].$explode[2]);
        
        $invoice = auth()->user()->invoices()->create([
            'serial_number' => $request->serial_number,
            'purchase_date' => $request->purchase_date,
            'proof_purchase' => $path,
            'application_number' => $request->application_number,
            'warranty_type' => 0,
            'contract_number' => $explode[0].$explode[1].$explode[2],
            'file_extension' => 'jpeg',
            'date_of_purchase' => Carbon::now(),
            'applied_date' => Carbon::now(),
            'expiration_date' => Carbon::now()->addYears(1),
        ]);

        $invoice_item = Invoice::find($invoice);
        $product = Product::find($request->product_id);
        $invoice->invoice_items()->create([
            'product_id' => $request->product_id,
            'unit_price' => $product->extended_amount,
            'discount' => 0,
            'total_price' => $product->extended_amount,
        ]);


        $admins = Admin::where('type', 0)->get();
        foreach ($admins as $admin) {
            $admin->notify(new OneYearWarrantyNotificationToAdmin($admin->email));
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
        
        $invoice = auth()->user()->invoices()->create([
            'serial_number' => $request->serial_number,
            'purchase_date' => $request->purchase_date,
            'proof_purchase' => $path,
            'application_number' => $request->application_number,
            'warranty_type' => 0,
            'contract_number' => $explode[0].$explode[1].$explode[2],
            'file_extension' => 'jpeg',
            'date_of_purchase' => Carbon::now(),
            'applied_date' => Carbon::now(),
            'expiration_date' => Carbon::now()->addYears(1),
        ]);

        $invoice_item = Invoice::find($invoice);

        $product = Product::find($request->product_id);

        $invoiceitem = $invoice->invoice_items()->create([
            'product_id' => $request->product_id,
            'unit_price' => $product->extended_amount,
            'discount' => 0,
            'total_price' => $product->extended_amount,
        ]);


        $admins = Admin::where('type', 0)->get();
        foreach ($admins as $admin) {
            $admin->notify(new OneYearWarrantyNotificationToAdmin($admin->email));
        }

        return response()->json([
            'message' => 1,
            'redirect' => route('checkout', $invoiceitem->id)
        ]);
    }

    public function userproduct()
    {
        return view('public.pages.user-products-page');
    }
}
