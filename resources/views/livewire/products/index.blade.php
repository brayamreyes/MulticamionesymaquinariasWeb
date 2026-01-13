<section class="py-10 container space-y-12">
    <div class="space-y-5">
        <div class="flex justify-between items-center">
            <p class="text-2xl font-bold text-primary">{{ $count }} <span class="font-normal">vehículos</span></p>
            <div class="flex space-x-3">
                <input wire:model.live="search" placeholder="Buscar" type="text" class="!text-gray bg-transparent border-none !w-auto focus-visible:outline-none">
                <select wire:model.live="sort" class="!text-gray bg-transparent border-none !w-auto font-semibold focus-visible:outline-none">
                    <option selected>Ordenar</option>
                    <option value="most_relevant">Más relevante</option>
                    <option value="lower_price">Menor precio</option>
                    <option value="higher_price">Mayor precio</option>
                    <option value="lower_mileage">Menos kilometraje</option>
                    <option value="most_recent_year">Año más reciente</option>
                </select>
            </div>
        </div>
        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <x-product :product="$product"/>
            @endforeach
        </div>
    </div>
    {{ $products->links() }}
</section>
