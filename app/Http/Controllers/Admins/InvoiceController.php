<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notifications\ApprovedWarrantyNotification;

use App\Invoice;
use App\InvoiceItem;
use App\User;

use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.applications.index');
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
            $invoice_item->update(['status' => 1]);
            $user = User::find($request->get('id'));
        DB::commit();  

        $user->notify(new ApprovedWarrantyNotification($user));

        return response()->json([
            'message' => 'You have successfully approved this request',
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
        if(auth()->user()->id === $invoice_item->invoice->id) {
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

        $item = [
            'invoice_item' => $invoice_item,
        ];

        return $item;
    }
}
