<div class="py-10 @if(request()->is('equipos')) pt-0 pb-14 @endif">
    <div class="container relative z-20">
        <div class="w-full" x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    perPage: 7,
                    gap: '0.3rem',
                    autoplay: true,
                    interval: 3000,
                    pagination: false,
                    rewind: true,
                    breakpoints: {
                        1024: {
                            perPage: 4
                        },
                        640: {
                            perPage: 2
                        }
                    }
                }).mount()
            }
        }">
            <section x-ref="splide" class="splide featured_products_splide {{count($categories) > 7 ? 'show_arrows' : 'hidden_arrows'}}">
                <div class="splide__track">
                    <div class="splide__list">
                        @foreach($categories as $category)
                            <div class="splide__slide">
                                <a href="/{{$category['page']['slug']}}" wire:navigate class="text-center block">
                                    @if($category['image'])
                                        <img src="{{url('storage/web/'. $category['image'])}}" alt="{{$category['name']}}" class="inline-block" />
                                    @else
                                        <img src="https://placehold.co/80x40" class="inline-block" />
                                    @endif
                                    <div class="text-xs text-gray pt-3">{{$category['name']}}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

