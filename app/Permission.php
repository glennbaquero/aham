<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Traits\HasRoles;

class Permission extends SpatiePermission
{
	public function category() {
		return $this->belongsTo(PermissionCategory::class, 'category_id');
	}
}
