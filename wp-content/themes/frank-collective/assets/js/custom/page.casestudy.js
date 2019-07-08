frank.ani_case_study_init = function (root) {
    var self = this;
    this.pages['case'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        nav: root.find('.header-case'),
        hero: root.find('.case-hero'),
        content: root.find('.case-study-content'),
        banner: root.find('.case-hero-banner'),
        bannerImage: root.find('.case-banner > *'),
        animatedBackground: root.find('.work-animated-background'),
        onResize: function (e) {

        }
    };

    this.pages['case'].banner.addClass('expanded');

    this.removeOverlay();

    if(this.pages['case'].animatedBackground.length){
        var timelineBackground = new TimelineMax()
          .to(this.pages['case'].animatedBackground, 1, {backgroundColor: '#ffffff', ease: Power1.easeNone});

        new ScrollMagic.Scene({
            triggerElement: this.pages['case'].content,
            triggerHook: 'onEnter',
            duration: 300
        })
          .setTween(timelineBackground)
          .addTo(self.pages['case'].controller);
    }
};

frank.ani_case_study_in = function (root) {
    var self = this;

    var overlay = $('.work-overlay');

    var timeline = new TimelineMax();

    if(overlay.length){
        timeline.to(overlay, 0.6, {xPercent: -100,  ease: frank.easeBezier}, 0)
    }
    timeline.to(frank.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut});

    setTimeout(function() {
        self.pages['case'].banner.removeClass('expanded');
        setTimeout(function() {
            frank.cache.$header.removeClass('nav-hidden');
            self.initUI();

            self.animations.initScrollNav();
            self.animations.initScrollNavDark();
            if(overlay.length){
                overlay.remove();
            }
        }, 900);
    }, 500);
};



frank.ani_related_case_out = function (el) {
    return new Promise(function(resolve, reject) {
        var
          offset = el.offset(),
          elOffsetTop = offset.top - $(document).scrollTop(),
          elOffsetLeft = offset.left - $(document).scrollLeft(),
          elWidth = el.width(),
          elHeight = el.height(),
          ctaContact = frank.pages['case'].root.find('.contact-cta'),
          ctaBack = frank.pages['case'].root.find('.link-to-back'),
          desc = el.find('p, h2');

        var linker = $('<div/>')
          .addClass('work-temp')
          .css({
              left: elOffsetLeft,
              top: elOffsetTop,
              width: elWidth,
              height: elHeight,
              zIndex: 99,
              'background-image': 'url('+el.data('image')+')'
          });

        $('.root').append(linker);

        var overlay = $('<div/>').addClass('work-overlay');

        $('#wrapper').append(overlay);
        TweenLite.set(overlay, {xPercent: 100, opacity: 1});

        frank.cache.$header.addClass('nav-hidden');
        $('.header-case').addClass('nav-hidden');

        el.css({
            visibility:'hidden'
        });

        new TimelineMax({
            onComplete: function () {
                resolve();
            }
        })
          .to(frank.cache.$footer, 0.4, {opacity: 0, y: 20, ease: Power1.easeOut}, 0)
          .to(ctaBack, 0.4, {opacity: 0, y: -50,  ease: Power1.easeOut}, 0)
          .to(ctaContact, 0.4, {opacity: 0, x: -50,  ease: Power1.easeOut}, 0)
          .to(desc, 0.3, {opacity: 0, x: 50,  ease: Power1.easeOut}, 0)
          .to(linker, 0.7, {left: 0, top: 0, width: frank.cache.clientWidth, height: frank.cache.clientHeight, scale: 1.04, zIndex: 999, ease: Power0.easeNone}, "-=0.5")
          .to(overlay, 0.6, {xPercent: 0,  ease: frank.easeBezier});
    });
};