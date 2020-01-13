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
    adaptiveHeight: true,
    infinite: true,
    slidesToShow: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    dots: true,
    customPaging: function(slick, index) {
        return '<span>' + (index + 1) + '</span>';
    }
});