<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

        return new Product([
            'category'     => $row[0],
            'product_name'    => $row[1],
            'photo' => $row[2],
         ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
