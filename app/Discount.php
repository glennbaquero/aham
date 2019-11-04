<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Discount extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class)->withTrashed();
    }

    public function prodcuts()
    {
    	return $this->hasMany(Product::class);
    }

    public static function store($request, $item = null)
    {
        if(!$item) {
            $item = static::create($request->all());
        } else {
            $item->update($request->all());
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
        return route('admin.discount.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.discount.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.discount.restore', $this->id);
    }
}
