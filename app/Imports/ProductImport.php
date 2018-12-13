<?php

namespace App\Imports;

use App\Product;
use App\Category;
use App\Type;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::firstOrCreate(['name' => $row['category_id']]);
        $type = Type::firstOrCreate(['name' => $row['type_id']])->first();

        return new Product([
            'model' => $row['model'],
            'category_id' => $category->id,
            'type_id' => $type->id,
            'specification' => $row['specification'],
            'brand' => $row['brand'],
            'extended_amount' => $row['extended_amount'],
            // 'quantity' => $row['quantity']
        ]);
    }
}
