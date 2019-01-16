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
    protected $images, $failed_img;

    public $errors = [];


    public function __construct($images)
    {
        $this->images = $images;
        // $this->errors = $errors;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($this->images);
        $category = Category::firstOrCreate(['name' => $row['category_id']]);
        $type = Type::firstOrCreate(['name' => $row['type_id']])->first();

        $images = explode(',', $row['image']);

        $product = Product::updateOrCreate([
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
                    $failed_img = $image;
                // ProductImage::create(['product_id' => $product->id, 'image' => $image]);
            }
        }

        foreach ($this->images as $filename) {
                    if($filename->getClientOriginalName() != $failed_img) {
                        $this->errors[] = [
                            'model' => $product->model,
                            'manifest_image_name' => $failed_img,
                        ];
                    }
                }
        // dd($this->errors);
        return $product; 
    }
}
