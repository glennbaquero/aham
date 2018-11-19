<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use App\Product;

class Type extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function products() {
    	return $this->hasMany(Product::class);
    }

    /*
     * Render
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderView() {
    	return route('regular.types.view', $this->id);
    }
}
