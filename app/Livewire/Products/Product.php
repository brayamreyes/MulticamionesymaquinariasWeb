<?php

namespace App\Livewire\Products;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Product as Products;
class Product extends Component {

    protected $meta;
    public $product;
    public $blocks = [];

    public function mount($slug) {
        $product = Products::where('slug', $slug)->where('is_published', true)->first();
        if ($product) {

            $seo_meta = new SEOMeta();
            $graph_meta = new OpenGraph();

            $title = $product->name;
            $description = null;
            $keywords = [];
            $image = null;

            if ($product->image_2) {
                $image = url('storage/web/' . $product->image_2);
            }

            if ($product->meta) {
                if ($product->meta->title) {
                    $title = $product->meta->title;
                }
                if ($product->meta->description) {
                    $description = $product->meta->description;
                }
                if ($product->meta->focus_keywords) {
                    $keywords = $product->meta->focus_keywords;
                }
                if ($product->meta->image_url) {
                    $image = $product->meta->image_url;
                }
            }

            $seo_meta::setTitle($title);
            $seo_meta::setCanonical(route('product.show', ['slug' => $product->slug]));

            if (count($keywords) > 0) {
                $seo_meta::setKeywords($keywords);
            }

            $graph_meta::setTitle($title);
            $graph_meta::setUrl(route('product.show', ['slug' => $product->slug]));

            if ($description) {
                $seo_meta::setDescription($description);
                $graph_meta::setDescription($description);
            }

            if ($image) {
                $graph_meta::addImage($image);
            }

            $this->product = $product;
            $this->blocks = collect($this->product->content)->map(function ($block) {
                $block['id'] = Str::uuid()->toString();
                return $block;
            })->toArray();
        }else {
            $this->redirect(route('page', ['slug' => "/"]));
        }
    }

    public function render() {
        return view('livewire.products.product');
    }
}
