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
    protected $request;
    protected $messages = [];

    public function __construct($request)
    {
        session()->forget('import_messages');
        session('import_messages');
        $this->request = $request;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::firstOrCreate(['name' => $row['category_id']]);
        $type = Type::firstOrCreate(['name' => $row['type_id']]);

        $product = Product::where('model', $row['model'])->first();

        $vars = [];
        $vars['category_id'] = $category->id;
        $vars['type_id'] = $type->id;
        $vars['specification'] = $row['specification'];
        $vars['brand'] = $row['brand'];
        $vars['extended_amount'] = $row['extended_amount'];

        if (!$product) {
            $vars['model'] = $row['model'];
            $product = Product::create($vars);
            session()->push('import_messages', "Product {$product->model} has been created.");
        } else {
            $product->update($vars);
            session()->push('import_messages', "Product {$product->model} has been updated.");
        }

        $manifestImages = explode(',', str_replace(' ', '', $row['image']));

        if ($this->request->hasFile('images') && count($manifestImages)) {
            foreach ($this->request->file('images') as $image) {
                if (in_array($image->getClientOriginalName(), $manifestImages)) {
                    $imageVars['product_id'] = $product->id;
                    $imageVars['image'] = $image->store('product-images', 'public');
                    ProductImage::create($imageVars);
                }
            }
        }

        return $product;
    }
}
