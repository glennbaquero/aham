<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Employee extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function discount() 
    {
    	return $this->hasMany(Discount::class);
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

     public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderDelete() {
        return route('admin.employee.destroy', $this->id);
    }

    public function renderView() {
        return route('admin.employee.edit', $this->id);
    }

    public function renderRestore() {
        return route('admin.employee.restore', $this->id);
    }
}
