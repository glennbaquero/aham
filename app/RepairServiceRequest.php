<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use DB;

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
        return $this->belongsToMany(InvoiceItem::class, 'service_request', 'request_id', 'user_product_id');
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

        $all_invoices = User::getInvoiceItems($request)->pluck('id');

        InvoiceItem::whereIn('id', $all_invoices)->update(['on_repair' => 0]);
        
        foreach ($request->get('userproducts') as $key => $value) {
            $invoice_items = InvoiceItem::find($request->input('userproducts')[$key]);
            if($request->get('userproducts')[$key]){
                $invoice_items->update(['on_repair' => 1]);
            }
        }

        $item->invoice_items()->sync($request->input('userproducts'));  

        return $item;
    }

    /**
     * @Getters
     */

    public static function getStatus() {
        return [
            ['value' => static::PENDING, 'label' => 'Pending', 'class' => 'bg-red'],
            ['value' => static::ONGOING, 'label' => 'On-going', 'class' => 'bg-blue'],
            ['value' => static::COMPLETE, 'label' => 'Complete', 'class' => 'bg-green'],
        ];
    }

    /**
     * @Helpers
     */
    public function renderConstants($array, $value, $column = null) {

        /* Loop through the array */
        foreach ($array as $obj) {
            
            if($obj['value'] == $value) {

                /* Fetch columm if specified */
                if($column && isset($obj[$column]))
                    return $obj[$column];

                return $obj;
            }
        }
    }

    /*
     * Render
     */

    public function renderFilePath($column = 'image') {
        $path = null;
        if (count($this->images)) { $path = $this->images()->first()->renderFilePath($column); }
        return $path;
    }

    public function renderStatusLabel() {
        return $this->renderConstants(static::getStatus(), $this->status, 'label');
    }

    public function renderStatusClass() {
        return $this->renderConstants(static::getStatus(), $this->status, 'class');
    }

    public function renderProductList() {
        return implode(', ', $this->invoice_items->pluck('product.name')->toArray());
    }

    public function renderName() {
        return '#' . $this->id;
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
