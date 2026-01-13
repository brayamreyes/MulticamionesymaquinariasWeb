<header
    x-data="{fixed: false}"
    @scroll.window="fixed = (window.pageYOffset < 50) ? false : true"
    :class="fixed ? 'header-fixed' : ''">
    <div class="container py-3">
        <div class="flex items-center justify-between h-16">
            <div class="flex justify-between items-center gap-12">
                <div>
                    <a href="{{config('app.url')}}" wire:navigate>
                        <img class="mx-auto" src="{{$logo}}" alt="{{config('app.name')}}">
                    </a>
                </div>
                <div class="hidden lg:flex space-x-8">
                    @if($menu->menuItems)
                        @foreach($menu->menuItems as $menuItem)
                            @if($menuItem->items->isEmpty())
                                <a href="{{ '/'. $menuItem->url }}" wire:navigate class="text-white">{{ $menuItem->name }}</a>
                            @else
                                <div class="relative" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false" @keydown.escape="dropdownOpen = false">
                                    <a @click="dropdownOpen = !dropdownOpen" class="text-white flex items-center gap-2 cursor-pointer">{{ $menuItem->name }}
                                        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 5.49988L10.6669 0.833008L12 2.16707L6 8.16707L0 2.16707L1.33312 0.833951L6 5.49988Z" fill="white"/>
                                        </svg>
                                    </a>
                                    <div :class=" dropdownOpen ? 'block' : 'hidden' " class="absolute bg-white text-black rounded-md shadow-md w-max">
                                        @foreach($menuItem->items as $item)
                                            <a href="{{ '/'. $item->url }}" wire:navigate class="flex items-center px-4 py-2 hover:bg-gray-100 gap-3 rounded-md">
                                                @php
                                                    $category_image = \App\Models\Category::where('slug', $item->slug)->first()->image ?? '';
                                                @endphp
                                                <img :src="'{{ url('storage/web/' . $category_image) }}'" class="w-[30px]" alt="{{ $item->name }}">
                                                <p class="text-gray text-sm">
                                                    {{ $item->name }}
                                                </p>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="/equipos" wire:navigate class="hidden lg:flex btn btn-secondary">
                Cotiza aquí
            </a>
            <div class="lg:hidden" x-data="{ isSidebarOpen: false }">
                <!-- Ícono del menú para dispositivos móviles -->
                <div>
                    <svg @click="isSidebarOpen = true" class="block cursor-pointer" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="7" y="11" width="24" height="3" fill="white"/>
                        <rect x="7" y="18" width="24" height="3" fill="white"/>
                        <rect x="7" y="25" width="24" height="3" fill="white"/>
                        <rect x="0.5" y="0.5" width="37" height="37" rx="2.5" stroke="white"/>
                    </svg>
                </div>
                <x-sidebar-mobile :menu="$menu" :logo="$logo" />
            </div>
        </div>
    </div>
</header>
