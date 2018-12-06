<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestRepairMan extends Model
{
	protected $guarded = [];
	
    public function repairservices() {
    	return $this->belongsTo(RepairServiceRequest::class);
    }

    public function repairman() {
    	return $this->hasOne(Admin::class);
    }
}
