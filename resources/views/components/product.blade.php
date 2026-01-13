@aware(['product'])

<div class="flex flex-col">
    @if($product->image_1)
        <img class="rounded-tr-lg rounded-tl-lg w-full h-[219px] object-cover" src="{{url('storage/web/' . $product->image_1)}}" alt="">
    @else
        <img class="rounded-tr-lg rounded-tl-lg w-full h-[219px] object-cover" src="{{asset('img/default.png')}}" alt="">
    @endif

    <div class="p-4 border rounded-bl-lg rounded-br-lg flex flex-col space-y-2">
        @if($product->type)
            <p class="text-xs text-primary font-semibold">{{ $product->type }}</p>
        @endif
        <p class="text-primary font-bold h-[44px] line-clamp-2">{{ $product->name }}</p>
        <div class="flex flex-col space-y-1 *:text-[#6B6B6B] *:text-xs">
            <p>Año: {{ $product->year_manufacture }}</p>
            <p>Kilometraje: {{ $product->mileage }}</p>
            <p>Horas: {{ $product->hours }}</p>
        </div>
        <div class="w-full h-[1px] bg-secondary-600"></div>
        <div class="flex items-baseline gap-2">
            <p class="text-lg font-bold text-primary">${{ number_format($product->dollar_final_price, 2) }}</p>
            <p class="text-xs font-bold text-gray">S/{{ number_format($product->pen_final_price,2) }}</p>
        </div>
        <a href="{{ route('product.show', ['slug' => $product->slug]) }}" wire:navigate class="btn btn-primary">Me interesa</a>
    </div>
</div>
