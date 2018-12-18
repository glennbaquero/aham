<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class ContactUs extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    const SALES = 0;
    const SERVICES = 1;

    public static function store($request, $item = null) {

    	if(!$item) {
    		$item = static::create($request->all());
    	} else {
    		$item->update($request);
    	}

    	return $item;

    }

    public static function getContact() {
        return [
            ['value' => static::SALES, 'label' => 'Sale'],
            ['value' => static::SERVICES, 'label' => 'Services'],
        ];
    }

    /*
     * @Renders
     */
    
    public function renderName() {
        return '#' . $this->id . ' ' . $this->contact;
    }

    public function renderView() {
    	return route('admin.contacts.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.contacts.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.contacts.restore', $this->id);
    }
}
