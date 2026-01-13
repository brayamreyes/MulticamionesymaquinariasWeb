<div style="--bg: {{$data['background']}};" class="sm:pb-10 pb-5 bg-[--bg] space-y-10 py-10">
    <h1 class="text-primary text-2xl font-medium text-center mb-5">{{$data['title']}}</h1>
    <div class="container relative z-20">
        <div class="w-full" x-data="{
            init() {
                new Splide(this.$refs.featured_products_splide, {
                    type: 'slide',
                    perPage: 4,
                    gap: '1rem',
                    arrows: true,
                    pagination: false,
                    rewind: true,
                    drag: true,
                    breakpoints: {
                        1024: {
                            perPage: 2,
                            drag: true,
                            arrows: false
                        },
                        768: {
                            perPage: 1,
                            drag: true,
                            arrows: false
                        }
                    }
                }).mount()
            }
        }">
            <section x-ref="featured_products_splide" class="splide featured_products_splide {{count($products) > 4 ? 'show_arrows' : 'hidden_arrows'}}">
                <div class="splide__track">
                    <div class="splide__list">
                        @foreach($products as $product)
                            <div class="splide__slide [&>div>div]:bg-white">
                                <x-product :product="$product"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
        @if($data['url'] && $data['text-button'])
            <div class="flex justify-center">
                <a href="{{$data['url']}}" class="btn btn-outline-secondary">{{$data['text-button']}}</a>
            </div>
        @endif
</div>
