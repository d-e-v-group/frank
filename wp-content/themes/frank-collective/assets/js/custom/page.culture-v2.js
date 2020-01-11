frank.ani_culture_2_init = function (root) {
  var self = this;
  this.pages['culture'] = {
      root: root,
      controller: new ScrollMagic.Controller(),
  };


  function get_url_extension( url ) {
    return url.split(/\#|\?/)[0].split('.').pop().trim();
  }

  $(document).ready(function(){

    var rellax = new Rellax('.rellax');

    
    $('.culture-looper').each(function(){
      var container = $(this);
      var vid_holder = container.find('.vid-holder');
      var img_holder = container.find('.img-holder');

      var frame1 = container.data('frame-one');
      var frame2 = container.data('frame-two');
      var frame3 = container.data('frame-three');

      var data = {
        delay: 1,
        frames: [
          {
            url: frame1,
            type: get_url_extension(frame1)
          },
          {
            url: frame2,
            type: get_url_extension(frame2)
          },          
          {
            url: frame3,
            type: get_url_extension(frame3)
          } 
        ]           
      }
      var loopIndex = 0;

      function advanceFrame() {
        TweenMax.to(container, 0.1, {alpha: 0, onComplete: function(){
          vid_holder.hide();
          img_holder.hide();
          var el = data.frames[loopIndex];
          if (el.type == 'mp4') {
            vid_holder.attr('src', el.url);
            vid_holder.show();
            TweenMax.to(container, 0.02, {alpha: 1, onComplete:function(){
                vid_holder[0].play();
              }
            });
          } else {
            img_holder.attr('src', el.url);
            img_holder.show();
            TweenMax.to(container, 0.02, {alpha: 1});
            setTimeout(function() {
              advanceFrame();
            }, 3000);
          }
          loopIndex = (loopIndex + 1) % data.frames.length;
        }});

      }

      vid_holder.on('ended',function(){
        advanceFrame();
      });

      advanceFrame();



      // container.html(render_frame(data.frames[0]));
      // var loopIndex = 1;


      // setInterval(function() {
      //   container.html(render_frame(data.frames[loopIndex]));
      //   loopIndex = (loopIndex + 1) % data.frames.length
      //   console.log(loopIndex)
      // }, 1000);

    });
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
