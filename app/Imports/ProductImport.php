<?php

namespace App\Imports; 

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProductImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row)
    {
    try {
        $d =  [
            'id' => $row[0],
            'product_name' => $row[1],
            'quantity' => $row[2],
            'created_at' => $row[3],
            'updated_at' => $row[4],
        ];
        echo "<pre>";
        print_r($d);
    } catch (\Throwable $th) {
        echo $th->getMessage(); 
    }
    }
} 
