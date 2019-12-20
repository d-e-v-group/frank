frank.ani_team_init = function (root) {
  var self = this;
  this.pages['team'] = {
      root: root,
      controller: new ScrollMagic.Controller(),
      // hero: root.find('.case-study-hero'),
      // content: root.find('.case-study-content'),
      // cultureSection: root.find('.culture-section'),
      teamSection: root.find('.team-section'),
      introSection: root.find('.team-section .intro'),
      // bannerImage: root.find('.banner > *'),
      // animatedBackground: root.find('.work-animated-background')
  };



  $('.team-list a').on('click', function (e) {
      e.preventDefault();
      var el = $(this),
        link = el.attr('href');
      self.cache.$header.addClass('nav-hidden');
      new TimelineMax({
          onComplete: function () {
              window.location.href = link;
          }
      })
        .to(self.cache.$footer, 0.4, {opacity: 0, y: 20, ease: Power1.easeOut}, 0)
        .to(self.pages['culture'].introSection, 0.4, {opacity: 0, x: -50,  ease: Power1.easeOut}, 0)
        .to(self.pages['culture'].cultureSection, 0.4, {opacity: 0, x: -50,  ease: Power1.easeOut}, 0)
        .staggerTo($('.team-item a'), 0.3, {opacity: 0, x: -50,  ease: Power1.easeNone}, 0.1, 0.1)
  });
};

frank.ani_team_in = function (root) {
  var self = this;
  this.removeOverlay();
  self.cache.$header.removeClass('nav-hidden');
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

frank.ani_bio_init = function (root) {
  var self = this;
  this.pages['bio'] = {
      root: root,
      contentLeft: root.find('.bio-content-left'),
      contentRight: root.find('.bio-content-right'),
      controller: new ScrollMagic.Controller(),
      animatedBackground: root.find('.work-animated-background')
  };
  TweenLite.set(this.pages['bio'].animatedBackground, {xPercent: 100});
  TweenLite.set(this.pages['bio'].contentLeft, {opacity:0, x: 100});
  TweenLite.set(this.pages['bio'].contentRight, {opacity:0, x: 100});
};

frank.ani_bio_in = function (root) {
  var self = this;
  this.removeOverlay();
  new TimelineMax({
      onComplete: function () {
      }
  })
    .to(this.cache.$header, 0.5, {opacity: 1, ease: Power1.easeOut}, 0)
    // .staggerTo(this.pages['works'].works, 0.4, {opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut}, 0.15, 0.3)
    .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
    .to(this.pages['bio'].animatedBackground, 1, {xPercent: 0, ease: Power1.easeOut}, 0)
    .to(this.pages['bio'].contentRight, 0.4, {opacity:1, x: 0, ease: Power1.easeOut}, 0.5)
    .to(this.pages['bio'].contentLeft, 0.4, {opacity:1, x: 0, ease: Power1.easeOut}, 0.7)
  ;
  self.initUI();
};