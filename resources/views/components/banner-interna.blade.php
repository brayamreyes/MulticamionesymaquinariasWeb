@aware(['data'])
@php
    $isBannerWithImage = $data['type_block'] === 'banner-with-image';
@endphp

<section>
    <div x-data="{ isMobile: window.innerWidth < 768 }">
        <div class="bg-secondary w-full {{ $isBannerWithImage ? 'h-[490px] lg:h-[382px] bg-bottom lg:bg-center bg-cover relative' : '' }}"
             @if($isBannerWithImage)
                 :style="isMobile ? '{{ isset($data['image_mobile']) ? 'background-image: url("' . url('storage/web/' . $data['image_mobile']) . '")' : '' }}' :'{{ isset($data['image']) ? 'background-image: url("' . url('storage/web/' . $data['image']) . '")' : ''}}'"
            @endif
        >
            @if($isBannerWithImage)
                <div class="absolute inset-0 bg-primary/55"></div>
            @endif
            <div class="container py-10 lg:py-8 {{ $isBannerWithImage ? 'h-full flex md:items-end' : '' }}" >
                <div class="flex flex-col space-y-2 {{ $isBannerWithImage ? 'triangle with-opacity' : 'triangle' }}">
                    <p class="text-white text-4xl">{{ $data['title'] }}</p>
                    @if($data['description'])
                        <p class="text-white text-sm">{{ $data['description'] }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($data['add_block_gray'])
        <div class="bg-gray-700 w-full">
            <div class="container mx-auto py-8">
                <p class="text-primary text-4xl">{{ $data['title_gray'] }}</p>
                <p class="text-primary">{{ $data['text'] }}</p>
            </div>
        </div>
    @endif
</section>
