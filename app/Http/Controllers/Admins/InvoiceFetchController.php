<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FetchController;

use App\Invoice;
use App\InvoiceItem;
use App\Product;

class InvoiceFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new InvoiceItem;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        if ($this->request->filled('search')) {
            $ids = $this->class::search($this->request->input('search'))->get()->pluck('id')->toArray();
            $query = $query->whereIn('id', $ids);
        }
        
        if($this->request->filled('status')) {
           $query = $query->where('status',  $this->request->input('status'));
        }

        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {
        $result = [];

        foreach($items as $item) {
            array_push($result, array(
                'id' => $item->id,
                'invoice' => $item->invoice,
                'serial_number' => $item->invoice->serial_number,
                'contract_number' => $item->invoice->contract_number,
                'file_extension' => $item->invoice->file_extension,
                'application_number' => $item->invoice->application_number,
                'status_label' => $item->renderStatusLabel(),
                'status_class' => $item->renderStatusClass(),
                'created_at' => $item->created_at->format('M d, Y (H:i:s)'),

                'actions' => array(
                    'view' => $item->renderView(),
                )
            ));
        }

        return $result;
    }

    public function fetchItem($id = null)
    {
        $item = null;

        if ($id) {
            $item = InvoiceItem::withTrashed()->find($id);
        	// $product = $item->invoice_items->pluck('product_id');
            $item->user = $item->invoice->user;
            $item->invoice_id = $item->invoice->id;
            $item->model = $item->product->model;
        	$item->invoice = $item->invoice;
            $item->serial_number = $item->invoice->serial_number;
            $item->contract_number = $item->invoice->contract_number;
            $item->file_extension = $item->invoice->file_extension;
            $item->application_number = $item->invoice->application_number;
            $item->purchase_date = $item->invoice->purchase_date;
            // $item->products = Product::find($product);
        }

        return response()->json([
            'item' => $item,
        ]);
    }

}
