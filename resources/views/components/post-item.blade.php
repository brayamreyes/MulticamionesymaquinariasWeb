@props(['post', 'style' => 1])
<div class="post-item style-{{$style}}">
    <div class="cover">
        <img src="{{url('storage/web/' . $post->image)}}" alt="{{ $post->title }}">
    </div>
    <div class="content">
        <p class="text-lg text-primary font-bold mb-2 title">{{ $post->title }}</p>
        <div class="summary">{!! $post->content !!}</div>
        <a href="{{ route('post.show', ['slug' => $post->slug]) }}" wire:navigate class="btn btn-outline-secondary w-fit mt-auto">Leer más</a>
    </div>
</div>
