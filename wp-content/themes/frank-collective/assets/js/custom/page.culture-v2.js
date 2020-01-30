frank.ani_culture_2_init = function (root) {
  var self = this;
  this.pages['culture'] = {
      root: root,
      // controller: new ScrollMagic.Controller(),
  };


  function get_url_extension( url ) {
    return url.split(/\#|\?/)[0].split('.').pop().trim();
  }

  $(document).ready(function(){


    var col1Height = $('.column-1').height();
    var col2Height = $('.column-2').height();


    $('.column-1-inner').clone().appendTo(".column-1");
    TweenMax.to( $(".column-1"), 60, 
        {
         y: -( col1Height ), 
         ease: Linear.easeNone,
         repeat: -1
        }
    );    
    


    $('.column-2-inner').clone().appendTo(".column-2");
    TweenMax.to( $(".column-2"), 100, 
        {
         y: -( col2Height ), 
         ease: Linear.easeNone,
         repeat: -1
        }
    );  
    
  })
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
