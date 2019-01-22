<?php

namespace App\Exports;

use App\InvoiceItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class WarrantiesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
	use Exportable;

	public function __construct($request_from, $request_to, $status)
	{
        $this->request_from = $request_from;
        $this->request_to = $request_to;
		$this->status = $status;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	if($this->status == 'all')
    	{
    		return collect($this->formatColumns(
                            InvoiceItem::whereBetween('created_at', [\Carbon\Carbon::parse($this->request_from), \Carbon\Carbon::parse($this->request_to)->endOfDay()])
                            ->get()
                    ));
    	} else {
    		return collect($this->formatColumns(
                            InvoiceItem::whereBetween('created_at', [\Carbon\Carbon::parse($this->request_from), \Carbon\Carbon::parse($this->request_to)->endOfDay()])
                            ->where('status', $this->status)
                            ->get()
                    ));
    	}

    	
        // return Invoice::all();
    }

    public function headings() : array
    {
    	return [
    		'ID',
    		'CUSTOMER',
    		'MODEL',
    		'SERIAL NUMBER',
    		'CONTRACT NUMBER',
    		'APPLICATION NUMBER',
    		'PURCHASE DATE',
    		'EXPIRATION DATE',
    		'WARRANTY TYPE',
    		'UNIT PRICE',
    		'DISCOUNT',
    		'TOTAL PRICE',
    	];
    }

    private function formatColumns($datas, $invoices = [])
    {
    	foreach ($datas as $data) {
			$formats = [
				'id' => $data->id,
				'customer' => $data->invoice->user->firstname. ' '.$data->invoice->user->firstname,
				'model' => $data->product->model,
				'serial_number' => $data->invoice->serial_number,
				'contract_number' => $data->invoice->contract_number,
				'application_number' => $data->invoice->application_number,
				'purchase_date' => $data->invoice->purchase_date,
				'expiration_date' => $data->invoice->expiration_date,
				'warranty_type' => $data->invoice->warranty_type == 0 ? 'BASIC' : 'EXTENDED',
				'unit_price' => $data->unit_price == null ? 0 : $data->unit_price,
				'discount' => $data->discount == null ? 0 : $data->discount,
				'total_price' => $data->total_price == null ? 0 : $data->total_price,
			];   
			array_push($invoices, $formats);
    	}

    	return $invoices;
    }
}
