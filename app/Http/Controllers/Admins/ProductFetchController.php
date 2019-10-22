<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use App\Product;

class ProductFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Product;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        if ($this->request->filled('search')) {
            $ids = $this->class::search($this->request->input('search'))->get()->pluck('id')->toArray();
            $query = $query->whereIn('id', $ids);
        }
        
        if($this->request->filled('tag_id')) {
           // $query = $query->whereHas('tags', function($query){
           //      $query->where('id', $this->request->input('tag_id'));
           //  });
           $query = $query->whereHas('category', function($query){
                $query->where('id', $this->request->input('tag_id'));
            });
        }

        // if($this->request->filled('categories') && count($this->request->input('categories'))) {
        //    $query = $query->whereIn('category_id', $this->request->input('categories'));
        // }

        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {
        $result = [];

        foreach($items as $item) {
            array_push($result, array(
                'id' => $item->id,
                'image' => $item->renderFilePath(),
                'model' => $item->model,
                'name' => $item->name,
                'extended_amount' => $item->extended_amount,
                'created_at' => $item->created_at->format('M d, Y (H:i:s)'),
                'tags' => $item->tags()->pluck('name')->toArray(),
                'category' => $item->category,

                'actions' => array(
                    'view' => $item->renderView(),
                    'set_as_featured' => $item->setAsFeatured(),
                )
            ));
        }

        return $result;
    }

    public function fetchItem($id = null)
    {
        $item = null;

        if ($id) {
            $item = Product::withTrashed()->find($id);
            $formatted_images = [];
            foreach($item->images as $image){
                $formatted_images[] = [
                    'id' => $image->id,
                    'path' => $image->renderFilePath(),
                    'url' => $image->renderDelete(),
                ];
            }
            $item->photos = $formatted_images;
            $item->product_tags = $item->tags()->count() ? $item->tags[0]->id : [];
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}
