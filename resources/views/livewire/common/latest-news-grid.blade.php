<div style="--bg: {{$data['background']}};" class="py-10 bg-[--bg]">
    <div class="container relative z-20">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-primary text-2xl font-medium">{{$data['title']}}</h1>
            @if($data['url'] && $data['text-button'])
                <a href="{{$data['url']}}" class="btn btn-outline-secondary text-center">{{$data['text-button']}}</a>
            @endif
        </div>
        <div class="max-md:hidden sm:grid grid-cols-2 gap-6">
            <div>
                <x-post-item :post="$posts[0]" />
            </div>
            <div class="space-y-5">
                <x-post-item :post="$posts[1]" :style="2" />
                <x-post-item :post="$posts[2]" :style="2" />
            </div>
        </div>
        <div x-ref="splide" class="splide with-pagination md:hidden max-md:!mb-10" x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    type: 'slide',
                    perPage: 3,
                    gap: '1rem',
                    arrows: false,
                    drag: false,
                    breakpoints: {
                        1024: {
                            perPage: 1,
                            drag: true,
                            arrows: false,
                            pagination: true
                        }
                    }
                }).mount()
            }
        }">
            <div class="splide__track">
                <div class="splide__list">
                    <div class="splide__slide">
                        <x-post-item :post="$posts[0]" />
                    </div>
                    <div class="splide__slide">
                        <x-post-item :post="$posts[1]" />
                    </div>
                    <div class="splide__slide">
                        <x-post-item :post="$posts[2]" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
