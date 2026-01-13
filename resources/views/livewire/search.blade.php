<section class="py-10 container space-y-12">
    <div class="space-y-5">
        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <x-product :product="$product"/>
            @endforeach
        </div>
    </div>
    {{ $products->links() }}
</section>
