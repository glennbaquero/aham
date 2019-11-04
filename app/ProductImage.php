<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\ProductImage;

class ProductImage extends Model
{
    protected $guarded = [];

    /**
     * @Relationships
     */
    public function product() {
    	return $this->belongsTo(Product::class)->withTrashed();
    }

    /**
     * @Renders
     */
    public function renderFilePath($column = 'image') {
        $path = null;
        if ($this[$column]) { $path = asset('storage/' . $this[$column]); }
        return $path;
    }

    public function renderDelete() {
        return route('admin.product-image.destroy', $this->id);
    }

}
