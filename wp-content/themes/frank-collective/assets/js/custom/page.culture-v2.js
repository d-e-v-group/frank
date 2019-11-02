frank.ani_culture_2_init = function (root) {
  var self = this;
  this.pages['culture'] = {
      root: root,
      controller: new ScrollMagic.Controller(),
  };
};

frank.ani_culture_2_in = function (root) {
  var self = this;
  self.animations.initScrollNav();
  self.animations.initScrollNavDark();  
  this.removeOverlay();
  self.cache.$header.removeClass('nav-hidden');
  new TimelineMax({
      onComplete: function () {
      }
  })

    .to(this.cache.$footer, 0.4, {opacity: 1, y: 0, ease: Power1.easeOut}, "-=0.4", 0)//Expo.easeOut
  ;
  self.initUI();
};
