@aware(['data'])
<section class="bg-gray-600">
    <div class="container py-14">
        <div class="flex flex-col lg:flex-row justify-center items-center gap-8 lg:gap-16">
            <embed src="{{ $data['embed'] }}" class="w-full lg:w-1/2 h-full min-h-[220px] md:h-[400px] object-cover object-center max-lg:order-2" />
            <div class="flex flex-col w-full lg:w-1/2 text-center divide-y divide-gray-700 lg:max-w-md">
                @foreach($data['items'] as $value)
                    <div class="flex flex-col items-start justify-start space-y-2 !w-full py-4 lg:py-8">
                        <div class="flex items-center justify-start w-full">
                            <img src="{{ url('storage/web/', $value['icono']) }}" class="w-[80px] h-a object-cover object-center" alt="{{ $value['title'] }}">
                        </div>
                        <p class="font-bold text-2xl text-primary">{{ $value['title'] }}</p>
                        <p class="text-gray text-start text-sm">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
