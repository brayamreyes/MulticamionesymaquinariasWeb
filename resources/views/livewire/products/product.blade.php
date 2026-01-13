<div>
    <div class="flex flex-col lg:flex-row h-auto bg-gray-600 max-lg:container max-lg:py-4 max-lg:gap-4">
        @if($product->image_2)
            <img class="w-full max-w-[814px] object-cover" src="{{url('storage/web/' . $product->image_2)}}" alt="{{$product->name}}">
        @else
            <img src="https://fakeimg.pl/814x447/?text=veh%C3%ADculo" alt="">
        @endif
        <div class="flex flex-col space-y-3 justify-center lg:px-16">
            @if($product->brand)
                @if($product->brand->image)
                    <img class="max-w-[83px] w-full" src="{{url('storage/web/' . $product->brand->image)}}" alt="{{$product->brand->name}}">
                @endif
            @endif
            <div class="flex flex-col w-full">
                @if($product->type)
                    <p class="text-sm text-gray font-bold">{{ $product->type }}</p>
                @endif
                <h1 class="text-primary font-bold text-3xl">{{ $product->name }}</h1>
            </div>
            <div class="flex flex-col space-y-1 *:text-[#6B6B6B] *:text-xs">
                @if($product->year_manufacture)
                    <p>Año: {{ $product->year_manufacture }}</p>
                @endif
                @if($product->mileage)
                    <p>Kilometraje: {{ $product->mileage }}</p>
                @endif
                @if($product->hours)
                    <p>Horas: {{ $product->hours }}</p>
                @endif
            </div>
            <div class="flex flex-col">
                <p class="text-3xl font-bold text-primary">${{ number_format($product->dollar_final_price, 2) }}</p>
                <p class="text-lg font-bold text-gray">S/{{ number_format($product->pen_final_price, 2) }}</p>
            </div>
            <div class="flex flex-col space-y-2 max-w-[220px]">
                <a href="{{route('product.quotation', ['slug' => $product->slug])}}" wire:navigate class="btn btn-primary bg-secondary">Cotiza aquí ahora</a>
                <a href="https://api.whatsapp.com/send?phone=51947714623&text=Hola%2C%20estoy%20interesado%20en%20obtener%20informaci%C3%B3n%20en%20{{ ($product->type ? $product->type . ' ' : '') }}{{ $product->name }}" target="_blank" class="btn btn-outline-secondary">Contacta con un asesor</a>
            </div>
        </div>
    </div>
    <div x-data="{ activeLink: null }" class="fixed z-50 left-0 top-[45%] flex flex-col gap-1 [&>a>div]:w-[57px] [&>a>div]:h-[46px] [&>a>div]:grid [&>a>div]:place-content-center">
        @if($blocks)
            @foreach($blocks as $block)
                @php $data = $block['data'] @endphp
                <a href="#{{ $block['id'] }}" class="group" @click="activeLink = '{{ $block['id'] }}'">
                    @if($block['type'] === 'general_specifications')
                        <div :class="{ 'bg-secondary': activeLink === '{{ $block['id']}}', 'bg-gray-600': activeLink !== 'especificaciones' }" class="w-full h-full group-hover:bg-secondary">
                            <img :class="{ 'invert brightness-0': activeLink === '{{ $block['id']}}', 'group-hover:invert w-full max-w-[24px] group-hover:brightness-0': activeLink !== 'especificaciones' }" src="{{ url('storage/web', $data['icon']) }}" alt="{{ $data['title'] }}"></img>
                        </div>
                    @endif
                    @if($block['type'] === 'vehicle_status')
                        <div :class="{ 'bg-secondary': activeLink === '{{ $block['id'] }}', 'bg-gray-600': activeLink !== '{{ $block['id'] }}' }" class="w-full h-full group-hover:bg-secondary">
                            <img :class="{ 'invert brightness-0': activeLink === '{{ $block['id'] }}', 'group-hover:invert w-full max-w-[24px] group-hover:brightness-0': activeLink !== 'status' }" src="{{ url('storage/web', $data['icon']) }}" alt="{{ $data['title'] }}">
                        </div>
                    @endif
                    @if($block['type'] === 'gallery')
                        <div :class="{ 'bg-secondary': activeLink === '{{ $block['id'] }}', 'bg-gray-600': activeLink !== '{{ $block['id'] }}' }" class="w-full h-full group-hover:bg-secondary">
                            <img :class="{ 'invert brightness-0': activeLink === '{{ $block['id'] }}', 'group-hover:invert w-full max-w-[24px] group-hover:brightness-0': activeLink !== 'gallery' }" src="{{ url('storage/web', $data['icon']) }}" alt="{{ $data['title'] }}">
                        </div>
                    @endif
                </a>
            @endforeach
        @endif
    </div>
    <div class="container py-10 lg:py-20 space-y-8 snap-start">
        @if($blocks)
            @foreach($blocks as $block)
                @php $data = $block['data'] @endphp
                <div class="scroll-mt-32" id="{{ $block['id'] }}">
                        @if($block['type'] === 'general_specifications')
                            <div class="sm:grid grid-cols-2 border-b pb-4">
                                <div class="flex gap-x-4 items-center">
                                    <img class="w-full max-w-[24px]" src="{{ url('storage/web', $data['icon']) }}" alt="{{ $data['title'] }}">
                                    <p class="text-2xl text-primary mb-0">{{ $data['title'] }}</p>
                                </div>
                                @if($product['data_sheet'])
                                    <div class="flex sm:justify-end justify-center">
                                        <a href="{{ url('storage/data-sheets', $product['data_sheet'])}}" download="" class="btn btn-primary">Descargar ficha</a>
                                    </div>
                                @endif
                            </div>
                            <x-product-accordion :data="$data" />
                        @endif
                        @if($block['type'] === 'vehicle_status')
                          <div class="flex flex-row justify-between items-center border-b pb-4">
                              <div class="flex gap-4 items-center">
                                  <img class="w-full max-w-[24px]" src="{{ url('storage/web', $data['icon']) }}" alt="{{ $data['title'] }}">
                                  <p class="text-2xl text-primary">
                                      {{ $data['title'] }}
                                  </p>
                              </div>
                          </div>
                          <div class="flex flex-col lg:flex-row items-center justify-center gap-8 max-w-4xl mx-auto py-10">
                              <div class="flex flex-col gap-3">
                                  @if($data['status'])
                                      <p class="text-lg text-primary font-bold">Estado: {{ $data['status'] }}</p>
                                  @endif
                                  <p class="text-sm text-gray max-w-xs">
                                      {{ $data['detail'] }}
                                  </p>
                              </div>
                              <embed src="{{ $data['link_video'] }}" alt="{{ $data['title'] }}" class="w-full min-h-[320px] aspect-video" />
                          </div>
                        @endif
                        @if($block['type'] == 'gallery')
                            <div class="flex justify-between items-center border-b pb-4">
                                <div class="flex gap-4 items-center">
                                    <img class="w-full max-w-[24px]" src="{{ url('storage/web', $data['icon']) }}" alt="{{ $data['title'] }}">
                                    <p class="text-2xl text-primary">
                                        {{ $data['title'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-8 py-10 max-w-4xl mx-auto">
                                <div class="flex flex-col gap-3">
                                    <p class="text-gray">{{ $data['detail'] }}</p>
                                    <x-product-gallery :data="$data['gallery']" />
                                </div>
                            </div>
                        @endif
                    </div>
            @endforeach
        @endif
            <section class="py-10">
                <div class=" rounded-lg flex justify-center bg-secondary">
                    <div class="p-8 flex max-lg:flex-col max-lg:gap-3 max-lg:*:text-center items-center justify-between w-full lg:max-w-4xl">
                        <p class="text-white text-2xl">
                            ¿Y tú, estás listo para tomar el volante al éxito?
                        </p>
                        <a href="/equipos" wire:navigate class="btn btn-white">
                            ¡Cotiza aquí ahora!
                        </a>
                    </div>
                </div>
            </section>
    </div>
</div>
