<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
	protected $guarded = [];

	const MINIMAL_COLUMN = [
		'id',
		'name',
	];

    public function products() {
    	return $this->belongsToMany(Product::class);
    }
}
