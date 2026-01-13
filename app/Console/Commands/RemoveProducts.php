<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-products';

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
            $product->meta?->delete();
            $product->delete();
        }
        DB::statement('ALTER TABLE products AUTO_INCREMENT=1;');

        $categories = Category::all();
        foreach ($categories as $category) {
            $category->meta?->delete();
            $category->page?->forceDelete();
            $category->delete();
        }
        DB::statement('ALTER TABLE categories AUTO_INCREMENT=1;');
    }
}
