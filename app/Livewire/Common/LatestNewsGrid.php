<?php

namespace App\Livewire\Common;

use App\Models\Post;
use Livewire\Component;

class LatestNewsGrid extends Component {

    public $posts = [];
    public $data = null;

    public function mount($data) {
        $this->posts = Post::latest()->take(3)->get();
        $this->data = $data;
    }

    public function render() {
        return view('livewire.common.latest-news-grid');
    }
}
