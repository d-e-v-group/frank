frank.ani_careers_init = function (root) {
    this.pages['careers'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        // hero: root.find('.case-study-hero'),
        // content: root.find('.case-study-content'),
        cultureSection: root.find('.culture-section'),
        teamSection: root.find('.team-section'),
        // bannerImage: root.find('.banner > *'),
        animatedBackground: root.find('.work-animated-background')
    };

    if(this.pages['careers'].animatedBackground.length){
        var timelineBackground = new TimelineMax()
          .to(this.pages['careers'].animatedBackground, 1, {backgroundColor: '#ffffff', ease: Power1.easeNone});

        new ScrollMagic.Scene({
            triggerElement: this.pages['careers'].teamSection,
            triggerHook: 'onEnter',
            duration: 300
        })
          .setTween(timelineBackground)
          .addTo(this.pages['careers'].controller);
    }
};

frank.ani_careers_in = function (root) {
    var self = this;
    this.removeOverlay();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax({
        onComplete: function () {
        }
    })
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    ;
    self.initUI();
};

frank.ani_archive_init = function (root) {
    var self = this;
    this.pages['archive'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        works: root.find('.work-item')
    };
};

frank.ani_archive_in = function (root) {
    var self = this;
    this.removeOverlay();
    self.animations.initScrollNav();
    self.animations.initScrollNavDark();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax({
        onComplete: function () {
        }
    })
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    ;
    self.initUI();
};

frank.ani_contact_cta_out = function (el) {
    return new Promise(function(resolve, reject) {
        var
          offset = el.offset(),
          elOffsetTop = offset.top - $(document).scrollTop(),
          elOffsetLeft = offset.left - $(document).scrollLeft(),
          elWidth = el.width(),
          elHeight = el.height(),
          ctaCase = $('.case-cta'),
          content = $('.default-content'),
          desc = el.find('p, h2');

        var linker = $('<div/>')
          .addClass('work-temp')
          .css({
              left: elOffsetLeft,
              top: elOffsetTop,
              width: elWidth,
              height: elHeight,
              zIndex: 99,
              backgroundColor: '#CBEEF4'
          });

        $('.root').append(linker);

        frank.cache.$header.addClass('nav-hidden');

        el.css({
            visibility:'hidden'
        });

        new TimelineMax({
            onComplete: function () {
                resolve();
            }
        })
          .to(frank.cache.$footer, 0.4, {opacity: 0, y: 20, ease: Power1.easeOut}, 0)
          .to(content, 0.4, {opacity: 0, y: -50,  ease: Power1.easeOut}, 0)
          .to(ctaCase, 0.4, {opacity: 0, x: 50,  ease: Power1.easeOut}, 0)
          .to(desc, 0.3, {opacity: 0, x: 50,  ease: Power1.easeOut}, 0)
          .to(linker, 0.7, {left: 0, top: 0, width: frank.cache.clientWidth, height: frank.cache.clientHeight, scale: 1.04, zIndex: 999, ease: Power0.easeNone}, 0);
    });
};

frank.ani_archive_out = function (item) {
    console.log('ARCHIVE OUT');
    return new Promise(function(resolve, reject) {
        var
          el = item.find('.img-box'),
          img = item.find('.inner-content'),
          offset = img.offset(),
          elOffsetTop = offset.top - $(document).scrollTop(),
          elOffsetLeft = offset.left - $(document).scrollLeft(),
          elWidth = el.width(),
          elHeight = el.height(),
          top = $('.top-row, .filter-drop'),
          bottom = $('.full-btn, .contact-cta');


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

        el.css({
            visibility:'hidden'
        });

        new TimelineMax({
            onComplete: function () {
                resolve();
            }
        })
          .to(frank.cache.$footer, 0.4, {opacity: 0, y: 20, ease: Power1.easeOut}, 0)
          .to(top, 0.4, {opacity: 0, y: -50,  ease: Power1.easeOut}, 0)
          .to(bottom, 0.4, {opacity: 0, y: 50,  ease: Power1.easeOut}, 0)
          .to(linker, 0.7, {left: 0, top: 0, width: frank.cache.clientWidth, height: frank.cache.clientHeight, scale: 1.04, zIndex: 999, ease: Power0.easeNone}, 0)
          .to(overlay, 0.6, {xPercent: 0,  ease: frank.easeBezier});
    });
};

frank.ani_default_init = function (root) {
    this.pages['default'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        animatedBackground: root.find('.work-animated-background')
    };
};

frank.ani_default_in = function (root) {
    var self = this;
    this.removeOverlay();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax({
        onComplete: function () {
        }
    })
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    ;
    self.initUI();
};

frank.ani_articles_init = function (root) {
    this.pages['articles'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        animatedBackground: root.find('.work-animated-background')
    };
};

frank.ani_articles_in = function (root) {
    var self = this;
    this.removeOverlay();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax({
        onComplete: function () {
        }
    })
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    ;
    self.initUI();
};