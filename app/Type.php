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
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderView() {
    	return route('admin.types.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.types.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.types.restore', $this->id);
    }
}
