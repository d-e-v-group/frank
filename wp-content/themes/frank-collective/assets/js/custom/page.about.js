frank.ani_about_init = function (root) {

    var self = this;
    this.pages['about'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        content: root.find('.about-content'),
        animatedBackground: root.find('.work-animated-background')
    };

    if(this.pages['about'].animatedBackground.length){
        var trigger = $('.trigger-hide-background').length ? $('.trigger-hide-background').eq(0) : this.pages['about'].content;

        console.log(trigger);
        var timelineBackground = new TimelineMax()
          .to(this.pages['about'].animatedBackground, 1, {backgroundColor: '#ffffff', ease: Power1.easeNone});

        new ScrollMagic.Scene({
            triggerElement: trigger,
            triggerHook: 'onEnter',
            duration: 300
        })
          .setTween(timelineBackground)
          .addTo(self.pages['about'].controller);
    }
};

frank.ani_about_in = function (root) {
    var self = this;
    this.removeOverlay();
    new TimelineMax({
        onComplete: function () {
        }
    })
      .to(this.cache.$header, 0.5, {opacity: 1, ease: Power1.easeOut}, 0)
      // .staggerTo(this.pages['works'].works, 0.4, {opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut}, 0.15, 0.3)
      .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    ;
    self.initUI();
};