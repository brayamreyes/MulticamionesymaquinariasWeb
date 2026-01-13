<?php

namespace App\Imports;

use App\Jobs\RegisterCustomer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Customers implements WithHeadingRow, ToCollection, WithCalculatedFormulas {

    public function collection(Collection $collection) {
        foreach ($collection as $r => $row) {
            RegisterCustomer::dispatch($row);
        }
    }
}
