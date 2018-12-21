<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use App\User;
use App\Invoice;
use App\InvoiceItem;

class UserProductFetchController extends FetchController
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
    	if(auth()->check()) {
	    	$query = $query->whereHas('invoice', function($query) {
	    		$query->where('user_id', auth()->user()->id);
	    	});
    	}

        if ($this->request->filled('search')) {
            $ids = $this->class::search($this->request->input('search'))->get()->pluck('id')->toArray();
            $query = $query->whereIn('id', $ids);
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
                'product' => $item->product,
                'invoice' => $item->invoice,
                'product_image' => $item->renderFilePath(),
                'created_at' => $item->created_at->format('M d, Y (H:i:s)'),
                'actions' => array(
                    // 'view' => $item->renderPublicView(),
                )
            ));
        }

        return $result;
    }


}
