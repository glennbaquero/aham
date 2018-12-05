<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class RepairServiceRequest extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    const PENDING = 10;
    const ONGOING = 20;
    const COMPLETED = 30;

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function repairman() {
    	return $this->belongsTo(RepairMan::class);
    }

    public function invoice_items() {
        return $this->belongsToMany(InvoiceItem::class, 'service_request', 'request_id', 'user_product_id')->with('product', 'invoice');
    }

    // public function repairman() {
    //     return $this->hasMany(RequestRepairMan::class);
    // }

    public static function store($request, $item = null) {

        if(!$item) {
            $vars = $request->only(['user_id', 'repair_men_id', 'complaint', 'solution', 'repair_cost', 'status']);
            $item = static::create($vars);

            $products = InvoiceItem::find($request->input('userproducts'));

        } else {

            if($request->repair_men_id === null) {
                $request->repair_men_id = $request->repairman;
            }

            $vars = $request->only(['repair_men_id', 'complaint', 'solution', 'repair_cost', 'status']);
            $item->update($vars);

        }
        
        RepairMan::find($request->repair_men_id)->update(['status'=>$request->status]);
        
        if ($request->filled('userproducts')) {
            $item->invoice_items()->sync($request->input('userproducts'));
        }
        
        return $item;
    }

    public static function getStatus() {
        return [
            ['value' => static::PENDING, 'label' => 'PENDING'],
            ['value' => static::ONGOING, 'label' => 'ONGOING'],
            ['value' => static::COMPLETED, 'label' => 'COMPLETED'],
        ];
    }

    public function getInvoiceItems() {
        $invoiceItems = [];
        
       
        $user = $this->user;
        $ids = $user->invoices();
        // $invoiceItems = InvoiceItem::with('product')->whereIn('invoice_id', $ids)->get();
        
        return $ids;
    }

    /*
     * Render
     */

     public function renderFilePath($column = 'image') {
        $path = null;
        if (count($this->images)) { $path = $this->images()->first()->renderFilePath($column); }
        return $path;
    }

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderView() {
    	return route('admin.request.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.request.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.request.restore', $this->id);
    }
}
