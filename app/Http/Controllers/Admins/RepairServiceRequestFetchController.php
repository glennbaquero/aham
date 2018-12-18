<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use App\RepairServiceRequest;
use App\User;
use App\Product;
use App\UserProduct;
use App\RepairMan;
use App\Admin;

class RepairServiceRequestFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new RepairServiceRequest;
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
                'user_name' => $item->user->renderFullname(),
                'user_link' => $item->user->renderView(),
                'repairman_name' => $item->repairman->admin->renderFullname(),
                'repairman_link' => $item->repairman->admin->renderView(),
                'products' => $item->renderProductList(),
                'complaint' => $item->complaint,
                'solution' => $item->solution,
                'created_at' => $item->created_at->format('M d, Y (H:i:s)'),
                'status_label' => $item->renderStatusLabel(),
                'status_class' => $item->renderStatusClass(),

                'actions' => array(
                    'view' => $item->renderView()
                )
            ));
        }

        return $result;
    }

    public function fetchItem($id = null)
    {
        $item = null;  
        $item = RepairServiceRequest::with('user')->withTrashed()->get();

        $repairmen = Admin::whereAvailableRepairman()->get();

        if ($id) {
            $item = RepairServiceRequest::with('user')->withTrashed()->find($id);
            $item->userproducts = $item->invoice_items()->pluck('id')->toArray();
            if ($item->repairman) {
                $item->repair_men_id = $item->repairman->admin_id;
                $repairmen =  $repairmen->toArray();
                array_push($repairmen, $item->repairman->admin->toArray());
            }
        }
        
        $users = User::select(User::MINIMAL_COLUMNS)->get();
        $statuses = RepairServiceRequest::getStatus();
        $repairmanstatus = RepairServiceRequest::all();

        return response()->json([
            'item' => $item,
            'users' => $users,
            'statuses' => $statuses,
            'repairmen' => $repairmen,
            'repairmanstatus' => $repairmanstatus,
        ]);
    }

    public function fetchUserInvoiceItems(Request $request) {
        $invoiceitem = User::getInvoiceItems($request);

        return response()->json([
            'invoice_items' => $invoiceitem,
        ]);
    }
}
