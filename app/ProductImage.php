<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\ProductImage;

class ProductImage extends Model
{
    protected $guarded = [];

    public function renderFilePath($column = 'image') {
        $path = null;
        if ($this[$column]) { $path = asset('storage/' . $this[$column]); }
        return $path;
    }

    public function product() {
    	return $this->belongsTo(Product::class);
    }

    public function update_image($path){
        $this->update(['image'=>$path]);
    }

    public function renderDelete() {
        return route('product-image.destroy', $this->id);
    }

}
