<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class UserDetail extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    
    public function user() {
    	return $this->belongsTo(User::class);
    }

    
    /*
     * Render
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderView() {
    	return route('regular.product.edit', $this->id);
    }
}
