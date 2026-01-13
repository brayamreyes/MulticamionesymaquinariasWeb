@aware(['data'])
<section class="container py-14 lg:py-20 border-b">
    <div class="flex flex-col lg:flex-row items-center max-lg:gap-6">
        <div class="flex flex-col w-full">
            <div class="[&>ul>li]:list-disc
            [&>ul]:lg:space-y-3 [&>ul]:pl-6 [&>ul>li]:text-sm
            [&>ul>li]:text-gray [&>h2]:text-primary [&>h2]:text-2xl space-y-4">
                @isset($data['icon'])
                    @if($data['icon'])
                        <img src="{{ url('storage/web/' . $data['icon']) }}" class="mb-6" alt="">
                    @endif
                @endisset
                {!! $data['text'] !!}
            </div>
        </div>
        <img src="{{ url('storage/web/' . $data['image']) }}" class="w-full object-cover object-center" alt="">
    </div>
</section>
