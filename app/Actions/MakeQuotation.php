<?php

namespace App\Actions;

use App\Models\Quotation;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class MakeQuotation {
    use AsAction;

    public function handle(Quotation $quotation) {
        try {
            $view = view('pdf.quotation', compact('quotation'));
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $pdf = new Dompdf($options);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHtml($view);
            $file = $quotation['code'] . ".pdf";
            Storage::disk('quotations')->put($file, $pdf->output());
            return ['status' => 'success'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }
}
