<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post as PostItem;
class Post extends Component
{
    public $post;
    public $postsWithTags;
    public function mount($slug){
        $this->post = PostItem::where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        $this->postsWithTags = PostItem::whereJsonContains('tags', $this->post->tags)
            ->where('id', '!=', $this->post->id)
            ->take(2)
            ->get();
        return view('livewire.posts.post');
    }
}
