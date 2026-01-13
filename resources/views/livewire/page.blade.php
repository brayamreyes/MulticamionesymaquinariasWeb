<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'products')
            <livewire:products.index :category_id="$block['data']['category_id']" :brand_id="$block['data']['brand_id']" :show_search="$block['data']['show_search']" />
        @endif

        @if($block['type'] === 'search-results')
            <livewire:search :data="$block['data']" />
        @endif

        @if($block['type'] === 'posts')
            <livewire:posts.index :data="$block['data']" />
        @endif

        @if($block['type'] === 'title_description')
            <x-title-description :data="$block['data']" />
        @endif

        @if($block['type'] === 'mision_vision')
            <x-mision-vision :data="$block['data']" />
        @endif

        @if($block['type'] === 'banner_interna')
            <x-banner-interna :data="$block['data']" />
        @endif

        @if($block['type'] === 'block_steps')
            <x-block-steps :data="$block['data']" />
        @endif

        @if($block['type'] === 'banner_accordion')
            <x-banner-accordion :data="$block['data']" />
        @endif

        @if($block['type'] === 'banner_gremcor')
            <x-banner-gremcor :data="$block['data']" />
        @endif

        @if($block['type'] === 'image_with_text_icon')
            <x-block-text-with-image :data="$block['data']" />
        @endif

        @if($block['type'] == 'slogan')
            <x-slogan :data="$block['data']" />
        @endif

        @if($block['type'] === 'slider')
            <livewire:common.slider :id="$block['data']['slider']" />
        @endif

        @if($block['type'] === 'products-search')
            <livewire:common.product-search :data="$block['data']" />
        @endif

        @if($block['type'] === 'block-1')
            <x-block-1 :data="$block['data']" />
        @endif

        @if($block['type'] === 'categories')
            <livewire:common.categories :data="$block['data']" />
        @endif

        @if($block['type'] === 'featured-products')
            <livewire:common.featured-products :data="$block['data']" />
        @endif

        @if($block['type'] === 'news')
            <livewire:common.latest-news-grid :data="$block['data']" />
        @endif

        @if($block['type'] === 'form')
            <livewire:common.form :data="$block['data']" />
        @endif

        @if($block['type'] === 'form_with_info_of_contact')
            <x-contact-form :data="$block['data']" />
        @endif
        @if($block['type'] === 'text')
            <x-block-text :data="$block['data']" />
        @endif
        @if($block['type'] === 'image')
            <x-block-image :data="$block['data']" />
        @endif
    @endforeach
</div>
