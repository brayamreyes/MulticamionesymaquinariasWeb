@aware(['data'])
<section id="gallery-carousel" class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($data as $item)
                <li class="splide__slide justify-center flex">
                    <img class="aspect-video object-center object-contain" src="{{ url('storage/web/' . $item) }}" alt="Galería">
                </li>
            @endforeach
        </ul>
    </div>
</section>
<ul id="thumbnails" class="thumbnails splide">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($data as $item)
                <li class="splide__slide justify-center flex thumbnail">
                    <img class="object-center object-cover" src="{{ url('storage/web/' . $item) }}" alt="Galería">
                </li>
            @endforeach
        </ul>
    </div>
</ul>
