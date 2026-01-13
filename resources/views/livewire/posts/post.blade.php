<section class="container py-10 lg:py-20 space-y-8">
    <div class="flex flex-col w-full space-y-2">
        <p class="text-primary text-2xl">Blog</p>
        <div class="h-[3px] w-full bg-[#E1E1E1]"></div>
    </div>
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="flex flex-col lg:col-span-2 space-y-5">
            <p class="text-2xl text-primary font-bold">{{ $post->title }}</p>
            <p class="text-gray text-xs">{{ $post->created_at }}</p>
            <img class="max-h-[500px] h-full object-cover object-center" src="{{ url('storage/web/' . $post->image) ?? 'https://fakeimg.pl/597x300/?text=art%C3%ADculo' }}" alt="">
             <div class="text-gray">{!! $post->content !!}</div>
        </div>
        <div class="bg-gray-600 lg:col-span-1 flex flex-col space-y-3 py-12 px-4">
            <p class="text-gray text-xl font-bold">Notas Relacionadas</p>
            @foreach($postsWithTags as $postRelated)
                <div class="flex flex-col rounded-lg border border-[#F0F0F0]">
                    <img src="{{ url('storage/web/' . $postRelated->image) ?? 'https://fakeimg.pl/328x279/?text=art%C3%ADculo' }}" alt="">
                    <div class="flex flex-col p-6 space-y-2 bg-white">
                        <p class="text-sm text-primary font-bold  line-clamp-2">{{ $postRelated->title }}</p>
                        <div class="text-sm text-gray line-clamp-3">{!! $postRelated->content !!}</div>
                        <a href="{{ route('post.show', ['slug' => $postRelated->slug]) }}" wire:navigate class="btn btn-white border border-secondary w-fit">Leer más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
