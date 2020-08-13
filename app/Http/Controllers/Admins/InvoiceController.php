<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WarrantiesExport;
use Illuminate\Support\Facades\Input; 

use App\Notifications\ApprovedWarrantyNotification;
use App\Notifications\ExtendedPaymentURLNotification;

use App\Invoice;
use App\InvoiceItem;
use App\User;
use App\Discount;

use DB;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\Applications\ApplicationIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\Applications\DestroyingApplicationMiddleware', ['only' => ['destroy', 'restore']]);
        $this->middleware('App\Http\Middleware\Admins\Applications\ApprovingApplicationMiddleware', ['only' => ['edit', 'update']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = json_encode(InvoiceItem::getStatus());
        return view('admin.applications.index', [
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.applications.edit', [
            'invoice' => InvoiceItem::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
            $invoice_item = InvoiceItem::find($id);
            $user = User::find($request->get('id'));

            if($invoice_item->invoice->warranty_type == 0){
                $invoice_item->update(['status' => InvoiceItem::APP_APPROVED]);
                $user->notify(new ApprovedWarrantyNotification($user));
            } else {
                $invoice_item->update(['status' => InvoiceItem::INVOICE_PENDING_PAYMENT]);
                $user->notify(new ExtendedPaymentURLNotification($invoice_item));
            }
        DB::commit();  


        return response()->json([
            'message' => 'You have successfully approved this request',
            'redirect' => $invoice_item->backToIndex(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice_item = InvoiceItem::find($id);
        $invoice_item->delete();

        return response()->json([
            'message' => "You have successfully archived this request",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $invoice_item = InvoiceItem::onlyTrashed()->find($id);
        $invoice_item->restore();

        return response()->json([
            'message' => "You have successfully restored this request",
        ]);
    }

    public function checkout($id) {
        $invoice_item = InvoiceItem::find($id);
        if(auth()->user()->id === $invoice_item->invoice->user_id && $invoice_item->status === 4 || 1 && !$invoice_item->invoice->has_notified) {
            return view('public.pages.checkout-page', [
                'invoice_item' => $invoice_item
            ]);
        }

        return back();
        
    }

    public function checkoutfetch($id) {
        $invoice_item = InvoiceItem::find($id);
        $invoice_item->invoice;
        $invoice_item->product;
        $discounts = Discount::where('product_id', $invoice_item->product->id)->get();

        $item = [
            'invoice_item' => $invoice_item,
            'discounts' => $discounts,
        ];

        return $item;
    }

    public function export()
    {
        $request_from = Input::get('from');
        $request_to = Input::get('to');
        $status = Input::get('status');

        // dd($request);
        return Excel::download(new WarrantiesExport($request_from, $request_to, $status), 'warranty_'.$request_from.'_'.$request_to.'.xlsx');
    }
}
