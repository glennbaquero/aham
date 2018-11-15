<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Role extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    /**
     * @TNT Search
     */
    public $asYouType = true;
    
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /*
     * Renders
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderView() {
    	return route('admin.roles.view', $this->id);
    }

}
