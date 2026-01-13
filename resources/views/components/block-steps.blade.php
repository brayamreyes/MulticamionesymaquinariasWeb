@aware(['data'])

<section class="container py-20">
    <div class="flex flex-col space-y-10">
        <p class="text-center text-primary text-2xl">
            {{ $data['title'] }}
        </p>
        <div x-ref="splide" class="splide with-pagination max-md:!mb-10" x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    type: 'slide',
                    perPage: 3,
                    arrows: false,
                    drag: false,
                    pagination: false,
                    breakpoints: {
                        1024: {
                            perPage: 2,
                            drag: true,
                            pagination: true
                        },
                        768: {
                            perPage: 1,
                            drag: true,
                            pagination: true
                        },
                    }
                }).mount()
            }
        }">
            <div class="splide__track">
                <div class="splide__list lg:flex-wrap">
                    @foreach($data['items'] as $key => $value)
                        <div class="splide__slide flex flex-col items-center justify-center space-y-3 relative px-3 lg:px-6 lg:py-5">
                            <div class="flex items-center justify-center w-full">
                                <img src="{{ url('storage/web/' . $value['icon']) }}" class="w-[80px] h-a object-cover object-center" alt="{{ $value['title'] }}">
                            </div>
                            <p class="font-bold text-lg text-primary">{{ $value['title'] }}</p>
                            <p class="text-sm text-gray-500 text-center">{{ $value['description'] }}</p>
                            @if($data['add_separator'])
                                @if (!$loop->first)
                                    <div class="max-lg:hidden absolute -left-14 top-10 -translate-x-1/2 w-[150px] h-[2px] bg-[#326BD6]"></div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if ($data['agregar_aviso'])
            <div class="w-full p-6 lg:py-5 lg:px-12 rounded-lg border border-secondary flex flex-col md:flex-row items-center gap-6">
                <img src="{{ url('storage/web/', $data['icon']) }}" alt="icono" />
                <p class="text-secondary max-md:text-center font-semibold">{{ $data['text'] }}</p>
            </div>
        @endif
    </div>
</section>
