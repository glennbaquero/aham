<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use App\Product;
use App\Category;

class ProductFetchController extends FetchController
{
    protected $total = 12;

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
        
        if(count($this->request->input('categories'))) {
           $query = $query->whereIn('category_id', $this->request->input('categories'));
        }

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

                'actions' => array(
                    'view' => $item->renderView(),
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
            $item->product_tags = $item->tags()->pluck('id')->toArray();
        }

        return response()->json([
            'item' => $item,
        ]);
    }

    public function fetchFilters() {
        $categories = Category::select(Category::MINIMAL_COLUMN)->get();

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
