<?php

namespace App\Exports;

use App\Models\Location;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection(
            [
                ['Sofa Leg', 'Handle leg', 'C:/user/desktop/handle.png'],
                ['Mortise handle', 'Handle 2', 'C:/user/desktop/handle_mortise.png'],
            ]
        );

        // return new Collection([
        //     [1, 2, 3],
        //     [4, 5, 6]
        // ]);
    }
    public function headings(): array
    {
        return [
            'Category Name',    'Product Name',    'Image',
        ];
    }
}
