@aware(['data'])
<div style="--bg: {{$data['background']}};" class="sm:py-10 py-5 bg-[--bg]">
    <div class="container relative z-20">
        <div class="sm:grid grid-cols-12 gap-5">
            @foreach($data['items'] as $item)
                <div class="col-span-4 border border-secondary rounded py-6 sm:px-3 px-6 w-full h-full flex justify-center sm:mb-0 mb-5">
                    <div class="sm:block grid grid-cols-2 text-center space-y-5 gap-5 items-center">
                        <div class="flex items-center  justify-center h-[84px]">
                            <img src="{{url('storage/web/' . $item['icon'])}}" class="inline-block " />
                        </div>
                        <div class="mt-auto">
                            <a href="{{$item['url']}}" wire:navigate class="btn btn-secondary sm:!px-12 mb-2 text-xl">{{$item['text-button']}}</a>
                            <p class="text-lg text-secondary">{{$item['content']}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
