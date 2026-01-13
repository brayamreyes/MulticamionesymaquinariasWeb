<section class="container pt-8 pb-14 space-y-12">
    <div class="flex flex-col space-y-4">
        <div class="flex justify-between items-center max-lg:gap-4">
            <input wire:model.live="search" placeholder="Buscar" class="bg-[#F8F8F8] border border-gray-700 py-2 px-4 focus-visible:outline-none max-w-sm" type="text">
            <div class="flex gap-3 items-center w-1/4">
                <p class="text-xs text-gray">Ordenar por:</p>
                <select wire:model.live="sort" class="bg-[#F8F8F8] text-gray border border-gray-700 py-2 px-4 focus-visible:outline-none *:text-gray">
                    <option selected>Ordenar</option>
                    <option value="newest">Más recientes</option>
                    <option value="oldest">Más antiguos</option>
                </select>
            </div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($posts as $post)
                <div class="flex flex-col space-y-2 rounded-lg border border-[#F0F0F0]">
                    <img class="object-cover w-full h-full max-h-[279px] rounded-tl-lg rounded-tr-lg" src="{{ url('storage/web/' . $post->image) ?? 'https://fakeimg.pl/328x279/?text=art%C3%ADculo' }}" alt="">
                    <div class="flex flex-col p-6 space-y-2">
                        <p class="text-sm text-primary font-bold">{{ $post->title }}</p>
                        <div class="text-xs text-gray line-clamp-2">{!! $post->content !!}</div>
                        <a href="{{ route('post.show', ['slug' => $post->slug]) }}" wire:navigate class="btn btn-white border border-secondary w-fit">Leer más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
</section>
