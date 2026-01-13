<?php

namespace App\Console\Commands;

use App\Actions\MakeDataSheet;
use App\Models\Product;
use Illuminate\Console\Command;

class GenerateDataSheets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-data-sheets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
        $products = Product::all();
        foreach ($products as $product) {
            MakeDataSheet::run($product);
        }
    }
}
