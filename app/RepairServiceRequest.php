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
    const COMPLETE = 30;

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function repairman() {
    	return $this->hasOne(RepairMan::class, 'request_id');
    }

    public function invoice_items() {
        return $this->belongsToMany(InvoiceItem::class, 'service_request', 'request_id', 'user_product_id')->with('product', 'invoice');
    }

    public static function store($request, $item = null) {

        if(!$item) {

        $vars = $request->only(['user_id', 'complaint', 'solution', 'repair_cost', 'status']);
            $item = static::create($vars);
            $item->repairman()->create(['admin_id' => $request->input('repair_men_id')]);

        } else {

            $vars = $request->only(['complaint', 'solution', 'repair_cost', 'status']);
            $item->update($vars);

            $item->repairman->update(['admin_id' => $request->input('repair_men_id')]);

        }
        
        $item->invoice_items()->sync($request->input('userproducts'));  

        return $item;
    }

    public static function getStatus() {
        return [
            ['value' => static::PENDING, 'label' => 'PENDING'],
            ['value' => static::ONGOING, 'label' => 'ONGOING'],
            ['value' => static::COMPLETE, 'label' => 'COMPLETE'],
        ];
    }

    public function getInvoiceItems() {
       
        $user = $this->user;
        $ids = $user->invoices();
        
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
