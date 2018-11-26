<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class RepairMan extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function request() {
    	return $this->hasMany(RepairServiceRequest::class);
    }

    
    /*
     * Renders
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }
}
