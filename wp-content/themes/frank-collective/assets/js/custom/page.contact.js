frank.ani_contact_init = function (root) {
    this.pages['contact'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        hero: root.find('.case-study-hero'),
        content: root.find('.case-study-content'),
        contactSection: root.find('.contact-section'),
        officesSection: root.find('.offices-section'),
        bannerImage: root.find('.banner > *'),
        animatedBackground: root.find('.work-animated-background')
    };
};

frank.ani_contact_in = function (root) {
    var self = this;
    this.removeOverlay();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax({
        onComplete: function () {
        }
    })
      // .to(this.pages['contact'].animatedBackground, 1.5, {backgroundColor: '#ffffff', ease: Power1.easeOut}, 0)
      // .staggerTo(this.pages['works'].works, 0.4, {opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut}, 0.15, 0.3)
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    ;
    self.initUI();
};