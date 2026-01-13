<?php

namespace App\Livewire;

use App\Concerns\Enums\Types;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Page extends Component {

    protected $meta;
    public $blocks = [];
    public \App\Models\Page $page;
    public $is_home = false;

    public function mount($slug = '/') {
        $model = \App\Models\Page::where('slug', $slug)->get()->first();
        if ($model) {
            $seo_meta = new SEOMeta();
            $graph_meta = new OpenGraph();

            $title = $model->name;
            $description = null;
            $keywords = [];
            $image = null;

            if ($model->meta) {
                if ($model->meta->title) {
                    $title = $model->meta->title;
                }
                if ($model->meta->description) {
                    $description = $model->meta->description;
                }
                if ($model->meta->focus_keywords) {
                    $keywords = $model->meta->focus_keywords;
                }
                if ($model->meta->image_url) {
                    $image = $model->meta->image_url;
                }
            }

            $seo_meta::setTitle($title);
            $seo_meta::setCanonical(route('page', ['slug' => $model->slug]));

            if (count($keywords) > 0) {
                $seo_meta::setKeywords($keywords);
            }

            $graph_meta::setTitle($title);
            $graph_meta::setUrl(route('page', ['slug' => $model->slug]));

            if ($description) {
                $seo_meta::setDescription($description);
                $graph_meta::setDescription($description);
            }

            if ($image) {
                $graph_meta::addImage($image);
            }

            $this->page = $model;
            $this->blocks = $model->content;
            $this->is_home = $model->type === Types::HOME->value;
        } else {
            $this->redirect(config('app.url'));
        }
    }
    public function render() {
        return view('livewire.page')->layout('layouts.app', ['class' => $this->is_home]);
    }
}
