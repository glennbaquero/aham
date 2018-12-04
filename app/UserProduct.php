<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;


class UserProduct extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function user() {
        return $this->belongsTo(User::class, 'user_id')->with('userdetail');
    }

    public function products() {
    	return $this->belongsTo(Product::class)->with('images');
    }

    public function servicerequest() {
        return $this->belongsToMany(RepairServiceRequest::class, 'service_request', 'request_id', 'user_product_id');
    }


    /*
     * Render
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }
    
}
