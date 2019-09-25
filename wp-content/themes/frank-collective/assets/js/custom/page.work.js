frank.getWorkCardPosition = function (el) {
    var item = $(el),
      position = item.data('position');
    if(position){
        var itemWidth = item.width(),
          descWidth = item.find('.desc').width(),
          imageWidth = itemWidth - descWidth,
          imageResizedWidth = imageWidth * 0.75,
          imageGap = (imageWidth - imageResizedWidth) / 4;
        if(position === 'left'){
            return -descWidth-imageGap;
        } else {
            return imageGap;
        }
    } else {
        return 0;
    }
};

frank.getWorkCardDescPosition = function (el) {
    var item = $(el),
      position = item.data('position');

    return (position === 'left') ? 400 : 200
};

frank.ani_works_init = function (root) {
    var self = this;
    this.pages['works'] = {
        root: root,
        backgrounds: [],
        works: root.find('.work-list .work-item'),
        worksLeft: root.find('.work-list .work-item.position-left'),
        worksRight: root.find('.work-list .work-item.position-right'),
        controller: new ScrollMagic.Controller(),
        workSection: root.find('.work-section'),
        animatedBackground: root.find('.work-animated-background'),
        onResize: function (e) {
            var workHeight = 0;
            self.pages['works'].works.each(function () {
                workHeight = Math.max(workHeight, $(this).outerHeight())
            });
            // artifacts sticking (height too large) when resizing browser up/down in size
            // self.pages['works'].works.css({
            //     height: workHeight
            // });


            var
              workSection = root.find('.work-section'),
              workSectionTopPostion = workSection.position().top,
              spacerOriginal = (self.cache.clientHeight - workHeight) / 2,
              spacerOriginalFirst = (self.cache.clientHeight - workHeight) / 3,
              spacerOriginalScaled = (self.cache.clientHeight - workHeight * 0.75) / 2,
              workPartialHeight = (self.cache.clientHeight - workHeight * 0.75) / 2,
              workSectionAdjust = Math.ceil(spacerOriginalScaled - spacerOriginal);

            self.pages['works'].works.each(function (index) {
                var
                  paddingTop = Math.max((index === 0) ? spacerOriginalFirst : spacerOriginal / 2.35 - workSectionAdjust, (index === 0) ? 60 : 30),
                  paddingBottom = Math.max(spacerOriginal / 2.35 - workSectionAdjust, 30);

                $(this).parents('.work-wrap').css({
                    'padding-top': paddingTop,
                    'padding-bottom': paddingBottom
                });
            });
        }
    };

    this.pages['works'].works.each(function () {
        var $this = $(this);
        self.pages['works'].backgrounds.push($this.data('backgroundColor'));
    });

    this.pages['works'].timelines = [];

    this.pages['works'].onResize();
    window.addEventListener('resize', this.pages['works'].onResize);
    TweenLite.set(this.cache.$footer, {opacity: 0, y: 20});
    TweenLite.set(this.pages['works'].worksLeft.slice(1), {opacity: 0, x: 50});
    TweenLite.set(this.pages['works'].worksRight, {opacity: 0, x: -50});
};

frank.ani_works_out = function (parent) {
    return new Promise(function(resolve, reject) {
        var el = parent.find('.featured-project'),
          offset = el.offset(),
          elOffsetTop = offset.top - $(document).scrollTop(),
          elOffsetLeft = offset.left - $(document).scrollLeft(),
          elWidth = el.width(),
          elHeight = el.height();
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

        $('.main').append(linker);

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
          .to(parent.parents('.work-list'), 0.7, {opacity: 0, ease: Power0.easeNone})
          .to(linker, 0.7, {left: 0, top: 0, width: frank.cache.clientWidth, height: frank.cache.clientHeight, scale: 1.04, zIndex: 999, ease: Power0.easeNone}, "-=0.5")
          .to(overlay, 0.6, {xPercent: 0,  ease: frank.easeBezier})
        ;
    });
};

frank.ani_works_in = function (root) {
    this.removeOverlay();
    frank.cache.$header.removeClass('nav-hidden');
    new TimelineMax()
      .staggerTo(this.pages['works'].works, 0.4, {opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut}, 0.15, 0.3)
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4")//Expo.easeOut
    ;
    this.initUI();
};
