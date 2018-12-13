<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class RepairMan extends Model
{
    use ActivityLogTrait, SoftDeletes;
    protected $guarded = [];

    public static function getModelEvents() {
        return [
            'created',
            'updated',
        ];
    }

    public function request() {
    	return $this->belongsTo(RepairServiceRequest::class, 'request_id');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id')->withTrashed();
    }

    /*
     * Renders
     */

    public function renderName() {
        return '#' . $this->id;
    }

    public function renderView() {
        return route('admin.request.edit', $this->request->id);
    }
}
