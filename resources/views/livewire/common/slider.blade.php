<div class="relative">
    @if($slide)
        @foreach($slide['slideItems'] as $item)
            <div class="absolute w-full top-0 left-0 h-full flex items-center">
                <div class="container relative z-20">
                    <div class="sm:w-[400px] max-sm:pt-20">
                        @foreach($item['content'] as $element)
                            @if($element['type'] === 'heading')
                                <h1 class="text-white text-3xl leading-14 mb-3">{{$element['data']['heading']}}</h1>
                            @endif
                            @if($element['type'] === 'button')
                                <a href="{{$element['data']['link']}}" wire:navigate class="btn btn-secondary w-fit">{{$element['data']['text']}}</a>
                           @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach($item['content'] as $element)
                @if($element['type'] === 'banner')
                    @if($element['data']['add_image_mobile'])
                        <img src="{{url('storage/web/' . $element['data']['image_mobile'])}}" class="w-full sm:hidden object-cover h-[580px]" alt="Imagen Slider" />
                        <img src="{{url('storage/web/' . $element['data']['image'])}}" class="w-full max-sm:hidden" alt="Imagen Slider" />
                    @else
                        <img src="{{url('storage/web/' . $element['data']['image'])}}" class="w-full max-sm:hidden" alt="Imagen Slider" />
                    @endif
                @endif
            @endforeach
        @endforeach
    @endif
    <div class="absolute inset-0 bg-gradient-to-l from-transparent to-slate-800 z-10"></div>
</div>
