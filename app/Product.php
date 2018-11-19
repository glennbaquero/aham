<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use App\Category;
use App\Type;

class Product extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function type() {
    	return $this->belongsTo(Type::class);
    }

    public function image() {
        return $this->hasMany(ProductImage::class);
    }
    
    public function product_image($request){
        $this->product_images()->create($request);
    }

    /*
     * Render
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderView() {
    	return route('regular.product.view', $this->id);
    }

    public function renderProductImage()
    {
        return $this->image;
    }
}
