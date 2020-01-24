frank.ani_homepage_init = function(root) {
    this.pages['homepage'] = {
        root: root,
        background: root.find('#homepage-background'),
        nav: root.find('.nav-links'),
        links: root.find('.nav-links a')
    };
    this.cache.$header.addClass('nav-hidden');
    TweenLite.set(this.cache.$header, { opacity: 0 });
    TweenLite.set(this.pages['homepage'].background, { opacity: 0 });
    TweenLite.set(this.pages['homepage'].links, { opacity: 0, visibility: 'hidden' });
};

frank.ani_homepage_in = function(root) {
    this.removeOverlay();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax()
        .to(this.pages['homepage'].background, 0.4, { opacity: 1, ease: Power1.easeOut }, "-=0.2")
        .staggerFromTo(this.pages['homepage'].links, 0.4, { opacity: 0, x: -40 }, { opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut }, 0.15, "-=0.2")
        .to(this.cache.$footer, 0.4, { opacity: 1, y: 0, ease: Power1.easeOut }, "-=0.4") //Expo.easeOut
    ;
};

frank.ani_homepage_out = function(root) {
    this.cache.$header.addClass('nav-hidden');
    new TimelineMax()
        .to(this.pages['homepage'].background, 0.4, { opacity: 1, ease: Power1.easeOut }, "-=0.2")
        .staggerTo(this.pages['homepage'].links, 0.4, { opacity: 0, x: -40, ease: Power1.easeOut }, 0.15, "-=0.2")
        .to(this.cache.$footer, 0.4, { opacity: 0, y: 20, ease: Power1.easeOut }, "-=0.4") //Expo.easeOut
    ;
};

$('.hp-slider').slick({
    adaptiveHeight: false,
    infinite: true,
    slidesToShow: 1,
    // autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    dots: true,
    appendDots: $('.pag-contain'),
    pauseOnHover: false,
    customPaging: function(slick, index) {
        var currSlide = slick.$slides.get(index);
        // add 'white' class to pagination when needed to match slide text choice; add numbers as pagination
        for (var i = 0; i < currSlide.children.length; i++) {
            if (currSlide.children[i].classList.contains('hp-slide-text-white')) {
                $('.slick-dots').ready(function() {
                    document.querySelector('.slick-dots').classList.add('white');
                    document.querySelector('header').classList.add('hp-white-text');
                    document.querySelector('.slick-next').classList.add('white');
                    document.querySelector('.slick-prev').classList.add('white');
                });
            }
        }
        return '<span>' + (index + 1) + '</span>';
    }
});

//change pagination color if necessary
$('.hp-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    //use currentSlide (index) to get slide html element  
    var nextSlide = slick.$slides.get(nextSlide);
    for (var i = 0; i < nextSlide.children.length; i++) {
        if (!nextSlide.children[i].classList.contains('hp-slide-text-white')) {
            document.querySelector('.slick-dots').classList.remove('white');
            document.querySelector('.slick-next').classList.remove('white');
            document.querySelector('.slick-prev').classList.remove('white');
            document.querySelector('header').classList.remove('hp-white-text');

        } else {
            document.querySelector('.slick-dots').classList.add('white');
            document.querySelector('.slick-next').classList.add('white');
            document.querySelector('.slick-prev').classList.add('white');
            document.querySelector('header').classList.add('hp-white-text');
        }
    }
})

$(document).ready(function() {
    loadSlideAssets();
});

// if mobile, show mobile versions of slider img/video from CMS
// show mobile img/vid div if .nav-opener display=block
function loadSlideAssets() {

    var mAssets = document.querySelectorAll('.mob-asset');
    var dAssets = document.querySelectorAll('.dt-asset');

    if ($('.nav-opener').css('display') == 'block') {
        dAssets.forEach(asset => {
            asset.style.display = 'none';
            asset.setAttribute('src', '');
        });

        mAssets.forEach(asset => {
            asset.setAttribute('src', asset.dataset.mobileAsset);
        });

    } else {

        mAssets.forEach(asset => {
            asset.style.display = 'none';
            asset.setAttribute('src', '');
        });

        dAssets.forEach(asset => {
            asset.setAttribute('src', asset.dataset.desktopAsset);
        });


    }

    //TODO: on resize, remove all src first and redefine
}