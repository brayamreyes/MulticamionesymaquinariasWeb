<?php

namespace App\Actions\Common;

use Lorisleiva\Actions\Concerns\AsAction;

class FormatNumeric {

    use AsAction;

    public function handle($value, $decimals = 0) {
        if (is_numeric($value)) {
            $value = number_format(round($value, 1), $decimals);
        }
        return $value;
    }
}
