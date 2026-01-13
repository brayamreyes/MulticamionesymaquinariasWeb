<?php

namespace App\Livewire\Posts;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $data;

    #[Url]
    public $sort = '';

    #[Url]
    public $search = '';
    public function mount($data)
    {
        $this->data = $data;
    }
    public function render()
    {
        $postQuery = Post::query()->where('status', \App\Concerns\Enums\Status::PUBLISHED);
        if ($this->sort === 'newest') {
            $postQuery->orderBy('created_at', 'desc');
        }
        if ($this->sort === 'oldest') {
            $postQuery->orderBy('created_at', 'asc');
        }
        if ($this->search) {
            $postQuery->where('title', 'like', '%'.$this->search.'%');
        }
        return view('livewire.posts.index', [
            'posts' => $postQuery->paginate(12),
        ]);
    }
}
