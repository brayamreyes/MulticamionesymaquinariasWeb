document.addEventListener('livewire:navigated', () => {
    var mainSplide = new Splide('#gallery-carousel', {
        pagination: false,
        arrows: false
    });

    var thumbnailSplide = new Splide('#thumbnails', {
        type: 'loop',
        perPage: 6,
        perMove: 1,
        arrows: false,
        pagination: false,
        isNavigation: true,
        focus: 'start',
        breakpoints: {
            768: {
                perPage: 4,
                perMove: 1
            },
        }
    });

    mainSplide.sync(thumbnailSplide);
    mainSplide.mount();
    thumbnailSplide.mount();

    mainSplide.on('moved', function(newIndex) {
        var thumbnails = document.querySelectorAll('#thumbnails .thumbnail');
        thumbnails.forEach((thumb, index) => {
            if (index === newIndex) {
                thumb.classList.add('is-active');
            } else {
                thumb.classList.remove('is-active');
            }
        });
    });
});
