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

    public function user() {
    	return $this->belongsTo(User::class)->with('userproducts');
    }

    public function repairman() {
    	return $this->hasOne(RepairMan::class);
    }

    public function userproduct() {
        return $this->belongsToMany(UserProduct::class, 'service_request', 'request_id', 'user_product_id')->with('user', 'product');
    }

    public static function store($request, $item = null) {


        if(!$item) {
            $item = static::create([
                'user_id' => $request->user,
                'repair_men_id' => $request->repair_men_id,
                'complaint' => $request->complaint,
                'solution' => $request->solution,
                'repair_cost' => $request->repair_cost,
            ]);

            $userproduct = UserProduct::find($request->userproducts);

            foreach ($request->userproducts as $key) {
                $item->userproduct()->sync($userproduct);
            }

        } else {
            $item->update([
                'repair_man_id' => $request->repair_man_id,
                'complaint' => $request->complaint,
                'solution' => $request->solution,
                'repair_cost' => $request->repair_cost,
            ]);
        }


        return $item;
    }

    /*
     * Render
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderView() {
    	return route('repair.request.edit', $this->id);
    }

    public function renderDelete() {
        return route('repair.request.destroy', $this->id);
    }

    public function renderRestore() {
        return route('repair.request.restore', $this->id);
    }
}
