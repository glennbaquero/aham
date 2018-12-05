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

    public function invoice() {
        return $this->belongsToMany(InvoiceItem::class, 'service_request', 'request_id', 'user_product_id')->with('product', 'invoice');
    }

    public static function store($request, $item = null) {

        if(!$item) {
            $item = static::create([
                'user_id' => $request->user,
                'repair_men_id' => $request->repair_men_id,
                'complaint' => $request->complaint,
                'solution' => $request->solution,
                'repair_cost' => $request->repair_cost,
                'status' => $request->status,
            ]);

        } else {

            if($request->repair_men_id === null) {
                $request->repair_men_id = $request->repairman;
            }

            $item->update([
                'repair_men_id' => $request->repair_men_id,
                'complaint' => $request->complaint,
                'solution' => $request->solution,
                'repair_cost' => $request->repair_cost,
                'status' => $request->status,
            ]);

            RepairMan::find($request->repairman)->update(['status'=>0]);

        }
        
        RepairMan::find($request->repair_men_id)->update(['status'=>1]);

        $userproduct = Invoice::find($request->userproducts);

        foreach ($request->userproducts as $key) {
            $item->invoice()->sync($userproduct);
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

    /*
     * Render
     */

     public function renderTableImage($column = 'image') {
        $path = null;
        if (count($this->images)) { $path = $this->images()->first()->renderTableImage($column); }
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
