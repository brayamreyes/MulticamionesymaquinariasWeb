<footer class="bg-primary">
    <div class="container py-6 md:py-10">
        <div class="grid md:grid-cols-5 max-md:space-y-4">
            <img class="mx-auto" src={{$logo}} alt="">
            <div class="md:col-span-2 flex flex-col gap-3 w-full">
                <div class="flex flex-col space-y-2">
                    @foreach($widgets->where('position', \App\Concerns\Enums\Positions::FOOTER_1->value) as $widget)
                        @foreach($widget->content as $block)
                            @if($block['type'] === 'icono_texto_link')
                                @foreach($block['data']['item'] as $item )
                                    <div class="flex gap-2 *:text-xs *:text-white">
                                        <img src="{{ url('storage/web/', $item['icono']) }}" alt="">
                                        <p>{{ $item['texto'] }}</p>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <div>
                    @foreach($widgets->where('position', \App\Concerns\Enums\Positions::FOOTER_2->value) as $widget)
                        @foreach($widget->content as $block)
                            @if($block['type'] === 'icono_texto_link')
                                @foreach($block['data']['item'] as $item )
                                    <a href="{{ $item['url'] }}" target="_blank">
                                        <img src="{{ url('storage/web/', $item['icono']) }}" alt="">
                                    </a>
                                @endforeach
                            @endif
                            @if($block['type'] === 'social_icons')
                                @if($block['data']['title'])
                                    <p class="mb-2 text-white">{{$block['data']['title']}}</p>
                                @endif
                                <div class="flex space-x-2">
                                    @php
                                        $general_settings = new \App\Settings\GeneralSetting();
                                    @endphp
                                    @if($general_settings->facebook_url)
                                        <a href="{{$general_settings->facebook_url}}" target="_blank">
                                            <img src="{{ asset('img/icon-facebook.svg') }}" alt="">
                                        </a>
                                    @endif
                                    @if($general_settings->instagram_url)
                                        <a href="{{$general_settings->instagram_url}}" target="_blank">
                                            <img src="{{ asset('img/icon-instagram.svg') }}" alt="">
                                        </a>
                                    @endif
                                    @if($general_settings->youtube_url)
                                        <a href="{{$general_settings->instagram_url}}" target="_blank">
                                            <img src="{{ asset('img/icon-youtube.svg') }}" alt="">
                                        </a>
                                    @endif
                                    @if($general_settings->linkedin_url)
                                        <a href="{{$general_settings->linkedin_url}}" target="_blank">
                                            <img src="{{ asset('img/icon-linkedin.svg') }}" alt="">
                                        </a>
                                    @endif
                                    @if($general_settings->tiktok_url)
                                        <a href="{{$general_settings->tiktok_url}}" target="_blank">
                                            <img src="{{ asset('img/icon-tiktok.svg') }}" alt="">
                                        </a>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="md:hidden h-[1px] bg-secondary my-6"></div>
            <div class="md:col-span-2 flex flex-col space-y-2 *:text-xs *:text-white">
                @foreach($widgets->where('position', \App\Concerns\Enums\Positions::FOOTER_3->value) as $widget)
                    @foreach($widget->content as $block)
                        @if($block['type'] == 'menu')
                            @php
                                $menu = \App\Models\Menu::find($block['data']['menu_id'])
                            @endphp
                            @foreach($menu->menuItems as $menuItem)
                                <a href="/{{ $menuItem->url }}" wire:navigate>{{ $menuItem->name }}</a>
                            @endforeach

                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="h-[1px] w-full bg-secondary my-6"></div>
        <p class="mx-auto text-center text-xs text-white">Copyright © {{ \Carbon\Carbon::now()->year }} Multicamiones y Maquinarias S.A. Todos los derechos reservados</p>
    </div>

    @if($whats_app_link)
        <a href="{{$whats_app_link}}" target="_blank" class="btn-whatsapp">
            <img src="{{asset('img/icon-whatsapp.svg')}}">
        </a>
    @endif
</footer>
