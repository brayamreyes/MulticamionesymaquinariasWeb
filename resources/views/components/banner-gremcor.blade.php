@aware(['data'])
<section class="container py-14 lg:py-20">
    <div class="flex flex-col justify-center items-center space-y-12">
        <div class="*:text-primary *:text-2xl max-w-3xl text-center">{!! $data['text'] !!}</div>
        <img src="{{ url('storage/web/' . $data['image']) }}" class="w-full lg:max-w-[704px] md:max-w-[500px] h-auto object-cover object-center" alt="">
    </div>
</section>
