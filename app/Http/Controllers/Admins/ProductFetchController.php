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

                'actions' => array(
                    'view' => $item->renderView()
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
            ;
            $formatted_images = [];
            foreach($item->images as $image){
                $formatted_images[] = [
                    'id' => $image->id,
                    'path' => $image->renderFilePath(),
                    'url' => $image->renderDelete(),
                ];
            }
            $item->photos = $formatted_images;
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}
