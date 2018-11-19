<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\ProductImage;

class ProductImage extends Model
{
    protected $guarded = [];

    public function product() {
    	return $this->belongsTo(Product::class);
    }

    public function update_image($path){
        $this->update(['image'=>$path]);
    }

}
