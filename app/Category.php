<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;
use App\Product;

class Category extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function products() {
    	return $this->hasMany(Product::class);
    }

    public static function store($request, $item = null) {
        $vars = $request->only('name');

        if(!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
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
    	return route('regular.categories.edit', $this->id);
    }

    public function renderDelete() {
        return route('regular.categories.destroy', $this->id);
    }

    public function renderRestore() {
        return route('regular.categories.restore', $this->id);
    }
}
