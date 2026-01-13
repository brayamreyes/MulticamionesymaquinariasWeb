<?php

namespace App\Imports;

use App\Jobs\RegisterProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Products implements WithHeadingRow, ToCollection, WithCalculatedFormulas {

    public function collection(Collection $collection) {
        foreach ($collection as $r => $row) {
            if ($r !== 0) {
                RegisterProduct::dispatch($row);
            }
        }
    }

}
