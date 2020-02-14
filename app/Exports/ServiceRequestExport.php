<?php

namespace App\Exports;

use App\InvoiceItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ServiceRequestExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

	public function __construct($product, $status)
	{
        $this->product = $product;
		$this->status = $status;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	// if($this->status == 'all')
    	// {
    		if($this->product == 'all') {
    			$invoice_items = InvoiceItem::all();
    		} else {
    			$invoice_items = InvoiceItem::where('product_id', $this->product)->get();
    		}
    		return collect($this->formatColumns(
                           $invoice_items
                    ));
    	// }

    	
        // return Invoice::all();
    }

    public function headings() : array
    {
    	return [
    		'ID',
    		'CUSTOMER',
    		'MODEL',
    		'COMPLAINT',
    		'REPAIRMAN ASSIGNED',
    		'STATUS',
    	];
    }

    private function formatColumns($datas, $array = [])
    {
    	foreach ($datas as $data) {
    		$requests = $this->status == 'all' ? $data->service_requests : $data->service_requests->where('status', $this->status);
    		foreach ($requests as $request) {
    			// dd();
    			$formats = [
    				'id' => $request->id,
    				'customer' => $data->invoice->user->firstname. ' '.$data->invoice->user->firstname,
    				'product' => $data->product->model,
    				'complaint' => $request->complaint,
    				'repairman' => $request->repairman->admin->renderFullname(),
    				'model' => $request->renderStatusLabel(),
    			];   
    			array_push($array, $formats);
    		}
			
    	}

    	return $array;
    }
}
