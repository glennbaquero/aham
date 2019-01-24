<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;
use App\Product;

class Category extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    const MINIMAL_COLUMN = [
        'id',
        'name',
    ];


    /**
     * @Relationships
     */
    
    public function products() {
    	return $this->hasMany(Product::class);
    }

    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /**
     * @Methods
     */
    
    public static function store($request, $item = null) {
        $vars = $request->only('name');
        $image = null;

        if($request->hasFile('image')) {
            $image = $request->file('image')->store('category-image', 'public');
            if($item && $item->image) {
                Storage::delete('public/' . $item->image);
            }
        }

        if(!$item) {
            $item = static::create([
                'name' => $request->input('name'),
                'availability' => $request->input('availability'),
                // 'image' => $image
            ]);

        } else {
            $item->update([
                'name' => $request->input('name'),
                'availability' => $request->input('availability'),
                // 'image' => $image
            ]);
        }

        if($image) {
            $item->update(['image' => $image]);
        }


        return $item;
    }

    public function fetchCategory($id = null) {
        $category = null;
        
        if($id){
            $category = $this->with(['products', 'products.images'])->find($id);
        } else {
            $category = $this->with(['products', 'products.images'])->get();
        }

        return $category;
    }

    /*
     * @Renders
     */

    public function renderFilePath($column = 'image') {
        $path = asset('storage/' . $this[$column]);
        return $path;
    }

    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderView() {
    	return route('admin.categories.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.categories.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.categories.restore', $this->id);
    }
}
