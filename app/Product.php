<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use App\Category;
use App\Type;

class Product extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    /**
     * @Relationships
     */

    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(ProductTag::class);
    }

    public function type() {
    	return $this->belongsTo(Type::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function userproduct() {
       return $this->hasMany(UserProduct::class);
    }

    public function user() {
       return $this->belongsTo(User::class);
    }
    
    public function product_image($request) {
        $this->product_images()->create($request);
    }

    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'product_id');
    }

    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'name' => $this->name,
            'extended_amount' => $this->extended_amount,
        ];
    }

    /**
     * @Methods
     */

    public static function store($request, $item = null) {
        $vars = $request->only(['name', 'model', 'extended_amount', 'description', 'specification', 'category_id', 'type_id']);

        if(!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('product-images', 'public');
                if($item && $item->images()->image){
                    Storage::delete('public/' . $item->images()->image);
                }
                $item->images()->create(['image' => $path]);
            }
        }

        $item->tags()->sync($request->input('product_tags'));

        return $item;
    }

    /*
     * Render
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderFilePath($column = 'image') {
        $path = null;
        if (count($this->images)) { $path = $this->images()->first()->renderFilePath($column); }
        return $path;
    }

    public function renderView() {
        return route('admin.product.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.product.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.product.restore', $this->id);
    }

    public function setAsFeatured() {
        return route('admin.product.featured', $this->id);
    }

    public function renderPublicView() {
        return route('view.product', $this->id);
    }

}
