<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;

class ExcelImport implements ToArray
{
    public function array(array $array)
    {
        return $array; // Return the entire data as an array
    }
}
