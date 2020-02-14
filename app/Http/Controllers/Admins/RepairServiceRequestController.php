<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRepairRequest;
use Illuminate\Http\Request;

use App\Notifications\AssignedTechnicianNotification;
use Illuminate\Support\Facades\Input; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServiceRequestExport;

use App\RepairServiceRequest;
use App\Admin;
use App\RepairMan;

use DB;

class RepairServiceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\RepairRequest\RepairRequestIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\RepairRequest\RepairRequestStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\RepairRequest\RepairRequestUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\RepairRequest\RepairRequestDestroyMiddleware', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = json_encode(RepairServiceRequest::getStatus());

        $requests = RepairServiceRequest::all();

        $products = [];

        foreach ($requests as $request) {
            foreach ($request->invoice_items as $item) {
                if(!collect($products)->contains('id', $item->product->id)) {
                    array_push($products, [
                        'id' => $item->product->id,
                        'name' => $item->product->model,
                    ]);
                }
                
            }
        }

        return view('admin.repairservice.request.index', [
            'status' => $status,
            'products' => json_encode($products),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.repairservice.request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRepairRequest $request)
    {
        DB::beginTransaction();
        $repair = RepairServiceRequest::store($request);        
        DB::commit();

        $repair_man = Admin::find($request->repair_men_id);

        $repair_man->notify(new AssignedTechnicianNotification($repair_man));

        return response()->json([
            'message' => 'A new request has been created!',
            'redirect' => $repair->renderView(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.repairservice.request.edit', [
            'request' => RepairServiceRequest::with('user')->withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRepairRequest $request, $id)
    {
        $repair = RepairServiceRequest::withTrashed()->find($id);
        DB::beginTransaction();
        $repair = RepairServiceRequest::store($request, $repair);     
        DB::commit();

        $repairman = $repair->repairman;
        
        if($repairman->wasChanged()) {
            $repair_man = Admin::find($request->repair_men_id);
            $repair_man->notify(new AssignedTechnicianNotification($repair_man));
        }

        return response()->json([
            'message' => "You have successfully updated {$repair->renderName()}",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repair = RepairServiceRequest::find($id);
        $repair->delete();

        return response()->json([
            'message' => "You have successfully archived {$repair->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $repair = RepairServiceRequest::onlyTrashed()->find($id);
        $repair->restore();

        return response()->json([
            'message' => "You have successfully restored {$repair->renderName()}",
        ]);
    }

    public function export()
    {
        $product = Input::get('product');
        $status = Input::get('status');
        $from = Input::get('from');
        $to = Input::get('to');

        // dd($request);
        return Excel::download(new ServiceRequestExport($product, $status, $from, $to), 'service-request_'.$product.'_status'.$status.'.xlsx');
    }
}
