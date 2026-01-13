@aware(['data'])
<section class="py-10 container">
    <div style="--bg: {{$data['background']}};"  class=" rounded-lg flex justify-center bg-[--bg]">
        <div class="p-8 flex max-lg:flex-col max-lg:gap-3 max-lg:*:text-center items-center justify-between w-full lg:max-w-4xl">
            <p class="text-white text-2xl">{{ $data['title'] }}</p>
            <a href="/{{ $data['url'] }}" wire:navigate class="btn btn-white">{{ $data['text-button'] }}</a>
        </div>
    </div>
</section>
