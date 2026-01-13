<?php

namespace App\Actions;

use App\Models\Product;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class MakeDataSheet {
    use AsAction;

    public function handle(Product $product) {
        $view = view('pdf.data-sheet', compact('product'));
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $pdf = new Dompdf($options);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHtml($view);
        $file = 'ficha-tecnica-' . $product['id'] . ".pdf";
        Storage::disk('data-sheets')->put($file, $pdf->output());
        $product->update(['data_sheet' => $file]);
    }
}
