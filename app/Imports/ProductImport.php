<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;

use Storage;
use File;

use App\Product;
use App\ProductImage;
use App\Category;
use App\Type;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = new Request;
        $category = Category::firstOrCreate(['name' => $row['category_id']]);
        $type = Type::firstOrCreate(['name' => $row['type_id']])->first();

        $images = explode(',', $row['image']);

        $product = Product::create([
            'model' => $row['model'],
            'category_id' => $category->id,
            'type_id' => $type->id,
            'specification' => $row['specification'],
            'brand' => $row['brand'],
            'extended_amount' => $row['extended_amount'],
            // 'quantity' => $row['quantity']
        ]);

        if($images) {
            foreach ($images as $image) {
                ProductImage::create(['product_id' => $product->id, 'image' => $image]);
            }
        }

        return $product; 
    }
}
