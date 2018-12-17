<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Faqs extends Model
{
 	use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function store($request, $item = null) {
    	$vars = $request->all();

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
        return route('admin.faqs.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.faqs.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.faqs.restore', $this->id);
    }
}
