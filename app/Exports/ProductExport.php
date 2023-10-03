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
                ['Sofa Leg', 'Handle leg', 'https://app.yogiindustries.co.in/images/product/16959704500.jpg','4 x 16','Matt','40','24'],
                ['Mortise handle', 'Handle 2', 'https://app.yogiindustries.co.in/images/product/16959704500.jpg','5 x 16','Matt','23','15'],
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

            'Category', 'Product', 'Image','Size (inch)', 'Finish[Matt/Glossy]','pcs/box','Box/case'
        ];
    }
}
