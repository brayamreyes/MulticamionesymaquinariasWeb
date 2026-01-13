@aware(['menu', 'logo'])
<div x-show="isSidebarOpen" class="fixed inset-0 z-40 md:hidden ">
    <div x-show="isSidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-full"
         class="container fixed inset-0 bg-primary z-50 overflow-y-auto">
        <div class="flex justify-between items-center py-3">
            <img src="{{$logo}}" alt="{{config('app.name')}}">
            <svg  @click="isSidebarOpen = false" class="cursor-pointer" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="26.9706" width="24" height="3" transform="rotate(-45 10 26.9706)" fill="white"/>
                <rect x="12.1213" y="10" width="24" height="3" transform="rotate(45 12.1213 10)" fill="white"/>
                <rect x="0.5" y="0.5" width="37" height="37" rx="2.5" stroke="white"/>
            </svg>

        </div>

        <div class="p-4 space-y-6 flex flex-col">
            <div class="flex flex-col space-y-2 *:text-white">

                @if($menu->menuItems)
                    @foreach($menu->menuItems as $menuItem)
                        @if($menuItem->items->isEmpty())
                            <a href="/{{ $menuItem->url }}" wire:navigate class="text-white">{{ $menuItem->name }}</a>
                        @else
                            <div x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center justify-between w-auto gap-2 text-white">
                                    {{ $menuItem->name }}
                                    <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" @click="open = !open">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" class="mt-2 space-y-2">
                                    @foreach($menuItem->items as $item)
                                        <a href="/{{ $item->url }}" wire:navigate class="block text-white px-4">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <a href="#" class="btn btn-secondary w-fit">Cotiza aquí</a>
            <div class="flex space-x-2">
                @php
                    $widget = \App\Models\Widget::where('parent_position', \App\Concerns\Enums\Positions::FOOTER->value)->get() ?? [];
                @endphp
                @foreach($widget->where('position', \App\Concerns\Enums\Positions::FOOTER_2->value) as $widget)
                    @foreach($widget->content as $block)
                        @if($block['type'] === 'icono_texto_link')
                            @foreach($block['data']['item'] as $item )
                                <a href="/{{ $item['url'] }}" target="_blank">
                                    <img src="{{ url('storage/web/', $item['icono']) }}" alt="">
                                </a>
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
