$.fn.isInViewportWithOffset = function(scrollTop, scrollBottom, _offset, log) {
    var el = jQuery(this);
    var elementTop = el.offset().top;
    var elementBottom = elementTop + el.outerHeight();
    var offset = frank.cache.clientHeight * _offset;
    var viewportTop = scrollTop + offset;
    var viewportBottom = scrollBottom - offset;
    if (log) {
        console.clear();
        console.log('elementTop', elementTop, 'viewportTop', viewportTop);
        console.log('elementBottom', elementBottom, 'viewportBottom', viewportBottom);
        console.log('offset', offset);
        if (elementBottom < viewportBottom && elementTop > viewportTop) {
            console.log('Appeared');
        }
    }
    // return viewportBottom > elementTop && viewportTop < elementBottom;
    return viewportBottom > elementTop;
};

window.frank = window.frank || {};

frank = {
    loadFallback: false,
    currentPage: false,
    loadedDom: false,
    pages: [],
    isPageTransition: false,
    mainController: new ScrollMagic.Controller(),
    easeBezier: new Ease(BezierEasing(.215, .61, .355, 1)),
    cache: {
        $html: $('html'),
        $body: $(document.body),
        $window: $(window),
        $main: $('#main'),
        $footer: $('#footer'),
        $header: $('#header'),
        $rootContainer: $('#main'),
        $preloaderOverlay: $('#preloader_overlay')
    },
    animations: {
        latestKnownScrollY: 0,
        oldScrollY: 0,
        ticking: false,
        preventAppearingAnimation: false,
    }
};

frank.animations.requestTick = function() {
    if (!this.ticking) {
        requestAnimationFrame(frank.animations.update);
    }
    this.ticking = true;
};
frank.animations.init = function() {
    frank.cache.$window
        // .off('scroll', this.onScroll)
        .on('scroll', this.onScroll).scroll();

    frank.cache.$window
        // .off('resize', this.onResize)
        .on('resize', this.onResize);

};
frank.animations.initScrollNavDark = function() {
    console.log('initSrollNavDark');
    var progressNav = $('[data-nav-dark]'),
        navSections = $('[data-dark]');
    if (progressNav.length && navSections.length) {
        this.navDark = {
            nav: progressNav,
            navItems: progressNav.find('li:not(.page-title)'),
            sections: navSections
        };
        this.calcScrollNavDark();
    } else {
        progressNav.addClass('dark')
    }

    if (progressNav.length) {
        this.navCase = {
            nav: progressNav,
            trigger: progressNav.next()
        };
        this.calcScrollNavCase();
    }
};

frank.animations.calcScrollNavDark = function() {
    var self = this;
    if (typeof this.navDark !== 'undefined') {
        if (this.navDark.sections.length) {
            this.navDark.sectionsBox = [];
            this.navDark.sections.each(function() {
                var el = $(this),
                    box = {
                        el: el,
                        top: el.offset().top,
                        height: el.outerHeight(),
                        bottom: el.offset().top + el.outerHeight()
                    };
                self.navDark.sectionsBox.push(box);
            });
        }
    }
};

frank.animations.initScrollNav = function() {
    var progressNav = $('[data-progress-nav]'),
        navSections = $('[data-nav-section]');
    if (progressNav.length && navSections.length) {
        this.progressNav = {
            nav: progressNav,
            navItems: progressNav.find('li:not(.page-title)'),
            sections: navSections
        };
        this.calcScrollNav();
    }
};
frank.animations.calcScrollNav = function() {
    var self = this;
    if (typeof this.progressNav !== 'undefined') {
        if (this.progressNav.sections.length) {
            this.progressNav.sectionsBox = [];
            this.progressNav.sections.each(function() {
                var el = $(this),
                    box = {
                        el: el,
                        top: el.offset().top,
                        height: el.outerHeight(),
                        bottom: el.offset().top + el.outerHeight()
                    };
                self.progressNav.sectionsBox.push(box);
            });
        }
    }
};

frank.animations.calcScrollNavCase = function() {
    if (typeof this.navCase !== 'undefined') {
        if (this.navCase.trigger.length) {
            var box = {
                el: this.navCase.trigger,
                top: this.navCase.trigger.offset().top,
                height: this.navCase.trigger.outerHeight(),
                bottom: this.navCase.trigger.offset().top + this.navCase.trigger.outerHeight()
            };
            this.navCase.triggerBox = box;
        }
    }
};

frank.animations.onScroll = function() {
    frank.animations.latestKnownScrollY = frank.cache.$window.scrollTop();
    frank.animations.requestTick();
};
frank.animations.onResize = function() {
    frank.animations.calcScrollNav();
    frank.animations.calcScrollNavDark();
    frank.animations.calcScrollNavCase();
};
frank.animations.update = function() {

    frank.animations.ticking = false;
    var scrollTop = frank.animations.latestKnownScrollY;
    var scrollBottom = frank.animations.latestKnownScrollY + frank.cache.clientHeight;
    var scrollMiddle = frank.animations.latestKnownScrollY + (frank.cache.clientHeight / 2);

    if (scrollTop < $(window).height()) {
        frank.cache.$header.addClass('on-top');
    } else {
        if (frank.cache.$header.hasClass('on-top')) {
            frank.cache.$header.removeClass('on-top')
        }
    }

    if (typeof frank.animations.progressNav !== 'undefined') {
        if (typeof frank.animations.progressNav.sections !== 'undefined') {
            var currentSection = 0;
            for (var i = 0; i < frank.animations.progressNav.sections.length; i++) {
                if (scrollMiddle > frank.animations.progressNav.sectionsBox[i].top) {
                    currentSection = i;
                }
            }
            frank.animations.progressNav.navItems.each(function(index) {
                if (currentSection > 1) {
                    var curNav = $(this);
                    if (index < currentSection - 1) {
                        curNav.addClass('hide');
                    } else {
                        curNav.removeClass('hide');
                    }

                } else {
                    frank.animations.progressNav.navItems.removeClass('hide');
                }
            });
            frank.animations.progressNav.navItems.removeClass('active');
            frank.animations.progressNav.navItems.eq(currentSection).addClass('active');
        }
    }

    if (typeof frank.animations.navDark !== 'undefined') {
        if (typeof frank.animations.navDark.sections !== 'undefined') {
            for (var i = 0; i < frank.animations.navDark.sections.length; i++) {
                if (scrollTop >= frank.animations.navDark.sectionsBox[i].top && scrollTop <= frank.animations.navDark.sectionsBox[i].bottom) { // +30
                    //frank.animations.navDark.nav.removeClass('dark')
                    frank.cache.$header.removeClass('dark')
                    if (frank.animations.navDark.nav.data('navDark') === 'main') {
                        //frank.animations.navDark.nav.addClass('light-main')
                        frank.cache.$header.addClass('light-main')
                    }
                    break;
                } else {
                    frank.animations.navDark.nav.addClass('dark')
                    if (frank.animations.navDark.nav.data('navDark') === 'main') {
                        //frank.animations.navDark.nav.removeClass('light-main')
                        frank.cache.$header.removeClass('light-main')
                    }
                }
            }
        }
    }

    if (typeof frank.animations.navCase !== 'undefined') {
        if (typeof frank.animations.navCase.triggerBox !== 'undefined') {
            if (scrollTop >= frank.animations.navCase.triggerBox.bottom) {
                frank.animations.navCase.nav.removeClass('nav-hidden');
                frank.cache.$header.addClass('nav-hidden');
            } else {
                frank.animations.navCase.nav.addClass('nav-hidden');
                frank.cache.$header.removeClass('nav-hidden');
            }
        }
    }

    /* Appearing Animations*/
    if (!frank.isPageTransition) {
        if (typeof frank.animations.appearingWork !== 'undefined' && frank.animations.appearingWork.length) {
            frank.animations.appearingWork.not('.is-appeared').each(function(index, item) {
                var el = $(item),
                    appearOffset = (typeof el.data('appearOffset') !== 'undefined') ? el.data('appearOffset') : 0.05;

                if (el.isInViewportWithOffset(scrollTop, scrollBottom, appearOffset)) {
                    el.addClass('is-appeared');
                }
            });
        }
    }

    if (!frank.animations.preventAppearingAnimation) {
        if (typeof frank.animations.appearingBlocks !== 'undefined' && frank.animations.appearingBlocks.length) {
            frank.animations.appearingBlocks.not('.is-appeared').each(function(index, item) {
                var el = $(item),
                    appearOffset = (typeof el.data('appearOffset') !== 'undefined') ? el.data('appearOffset') : 0.05;

                if (el.isInViewportWithOffset(scrollTop, scrollBottom, appearOffset)) {
                    el.addClass('is-appeared');
                }
            });
        }

        if (typeof frank.animations.appearingGroups !== 'undefined' && frank.animations.appearingGroups.length) {
            frank.animations.appearingGroups.not('.is-appeared').each(function(index, item) {
                var el = $(item),
                    appearOffset = (typeof el.data('appearOffset') !== 'undefined') ? el.data('appearOffset') : 0.05;

                if (el.isInViewportWithOffset(scrollTop, scrollBottom, appearOffset)) {
                    el.addClass('is-appeared');
                }
            });
        }

        if (typeof frank.animations.appearingCommons !== 'undefined' && frank.animations.appearingCommons.length) {
            frank.animations.appearingCommons.not('.is-appeared').each(function(index, item) {
                var el = $(item),
                    appearOffset = (typeof el.data('appearOffset') !== 'undefined') ? el.data('appearOffset') : 0.05;
                if (el.isInViewportWithOffset(scrollTop, scrollBottom, appearOffset)) {
                    el.addClass('is-appeared');
                }
            });
        }
    }
    /* Appearing Animations END*/

    /* Sticky Header */
    if (frank.animations.latestKnownScrollY > frank.animations.oldScrollY) {
        if (frank.animations.latestKnownScrollY > 100) {
            frank.cache.$body.addClass('header-sticky');
            if (frank.cache.$body.hasClass('header-visible')) {
                frank.cache.$body.removeClass('header-visible');
            }
        }
    } else {
        if (frank.animations.latestKnownScrollY < frank.animations.oldScrollY) {
            frank.cache.$body.addClass('header-sticky').addClass('header-visible');

            if (frank.animations.latestKnownScrollY < 100) {
                frank.cache.$body.removeClass('header-sticky header-visible');
            }
        }
    }


    frank.animations.oldScrollY = frank.animations.latestKnownScrollY;
}

frank.preloadImages = function() {
    if ($('[data-preload-image]').length > 0) {
        var preloadImages = [];
        $('[data-preload-image]').each(function() {
            var imgUrl = $(this).data('preloadImage');
            if (imgUrl !== '') {
                preloadImages.push(imgUrl);
            }
        });
        if (preloadImages.length) {
            for (var i = 0; i < preloadImages.length; i++) {
                var item = $('<div class="preload-image" style="background-image: url(' + preloadImages[i] + ')"></div>');

                $('.section-culture').append(item);
            }
        }
    }
};

frank.onAjaxPageLoadClick = function(e) {
    e.preventDefault();
    console.log('this is the page transition');
    if (frank.isPageTransition) {
        return false;
    }

    frank.isPageTransition = true;

    var el = $(this),
        oldContainer = $('.root'),
        transitionIn = el.data('transitionIn'),
        transitionOut = el.data('transitionOut') ? el.data('transitionOut') : frank.cache.$rootContainer.find('.root').data('transitionOut'),
        link = el.attr('href') ? el.attr('href') : el.data('link');
    console.log('out animation', transitionOut);
    if (typeof frank['ani_' + transitionOut] === 'function') {
        Promise.all([frank['ani_' + transitionOut](el), frank.ajaxPageLoad(link)]).then(function() {
            clearTimeout(frank.loadFallback);
            console.log('animate the thing');
            window.scrollTo(0, 0);
            var
                $dom = $(frank.loadedDom),
                newContainer = $dom.find('.root'),
                newTitle = $dom.find('title');

            newContainer
                .css({
                    'display': 'none'
                })
                .appendTo(frank.cache.$rootContainer);

            var page_init = newContainer.data('pageInit'),
                page_in = (transitionIn) ? transitionIn : newContainer.data('transitionIn');

            // frank.currentPage = next_page_id;

            if (typeof frank['ani_' + page_init] === 'function') {
                frank['ani_' + page_init](newContainer);
            }

            oldContainer.css({
                'display': 'none'
            });

            newContainer
                .css({
                    'display': 'block'
                });

            oldContainer.remove();
            frank.cache.$body.removeClass('is-loading');

            if (typeof frank['ani_' + page_in] === 'function') {
                frank['ani_' + page_in](newContainer);
            }

            frank.isPageTransition = false;
            history.pushState({}, newTitle, link);
        });

    }
};

frank.initAjaxPageLoad = function() {
    $('#main')
        .off('click', '.ajax-load', frank.onAjaxPageLoadClick)
        .on('click', '.ajax-load', frank.onAjaxPageLoadClick);
};

frank.ajaxPageLoad = function(linkUrl) {
    return new Promise(function(resolve, reject) {
        jQuery.get(linkUrl, function(data) {
            frank.loadedDom = data;
            var assets = $(data).find('.ajax-preload-assets');
            var backgrounds = $(data).find('[data-ajax-preload-assets]');

            frank.loadFallback = setTimeout(function() {
                window.location.href = linkUrl;
            }, 3000);

            if (!assets.length && !backgrounds.length) {
                console.log('resolve no assets')
                resolve();
            }
            if (assets.length) {
                assets.get()[0].addEventListener('loadeddata', function() {
                    console.log('resolve video loaded')
                    resolve();
                })
            }
            if (backgrounds.length) {
                var image = new Image();
                image.onload = function() {
                    console.log('resolve image loaded')
                    resolve();
                };
                image.onerror = function() {
                    resolve();
                };
                image.src = assets.eq(0).data('ajax-preload-assets');
            }
        });
    });
};

frank.init = function() {
    this.preloadImages();
    this.initResize();
    this.animations.init();
};

frank.initUI = function() {
    this.initAjaxPageLoad();
    this.initSliders();
    this.initBigHeader();
    this.initAppearAnimation();
    this.initContactCTA();
    this.initMobileVideos();
};

frank.initMobileVideos = function() {
    $('.video-has-mobile').each(function() {
        var video = $(this);
        if (frank.cache.mediaWidth < 767) {
            video.append('<source src="' + video.data('mobileVideoSrc') + '" type="video/mp4" >');
        } else {
            video.append('<source src="' + video.data('videoSrc') + '" type="video/mp4" >');
        }
    })
};

frank.initResize = function() {
    frank.cache.$window.on('resize', function() {
        frank.cache.mediaWidth = window.innerWidth;
        frank.cache.clientWidth = frank.cache.$window.width();
        frank.cache.clientHeight = frank.cache.$window.height();
    }).resize();
};

frank.initContactCTA = function() {
    var self = this;
    $('.cta.contact-cta').on('click', function(e) {
        e.preventDefault();
        var el = $(this),
            link = el.attr('href'),
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
            visibility: 'hidden'
        });

        new TimelineMax({
                onComplete: function() {
                    window.location.href = link;
                }
            })
            .to(frank.cache.$footer, 0.4, { opacity: 0, y: 20, ease: Power1.easeOut }, 0)
            .to(content, 0.4, { opacity: 0, y: -50, ease: Power1.easeOut }, 0)
            .to(ctaCase, 0.4, { opacity: 0, x: 50, ease: Power1.easeOut }, 0)
            .to(desc, 0.3, { opacity: 0, x: 50, ease: Power1.easeOut }, 0)
            .to(linker, 0.7, { left: 0, top: 0, width: frank.cache.clientWidth, height: frank.cache.clientHeight, scale: 1.04, zIndex: 999, ease: Power0.easeNone }, 0);
    });
};

frank.initBigHeader = function() {
    var self = this;
    $('[data-big-header]').each(function() {
        var el = $(this),
            trigger = (parseFloat(el.data('offset')) >= 0) ? parseFloat(el.data('offset')) : 500,
            delayAfter = (parseFloat(el.data('offset')) >= 0) ? parseFloat(el.data('offset')) : 300;
        frank.animations.preventAppearingAnimation = true;
        setTimeout(function() {
            el.addClass('is-appeared');

            setTimeout(function() {
                frank.animations.preventAppearingAnimation = false;
                frank.cache.$window.scroll();
            }, delayAfter);
        }, trigger);
    });
};

frank.initAppearAnimation = function() {
    var self = this;

    frank.animations.appearingWork = $('[data-work-item]');
    frank.animations.appearingBlocks = $('[data-appear-block]');
    frank.animations.appearingGroups = $('[data-appear-group]');
    frank.animations.appearingCommons = $('[data-appear-text], [data-appear-text-group], [data-appear-fade-in], [data-med-header]');


    if (frank.animations.appearingBlocks.length) {
        frank.animations.appearingBlocks.each(function() {
            var el = $(this),
                delay = (parseFloat(el.data('animationDelay')) >= 0) ? parseFloat(el.data('animationDelay')) : 0.15;
            el.find('> *').each(function(index) {
                var item = $(this);
                if (index > 0) {
                    item
                        .attr('data-transition-delay', (index * delay) + 's')
                        .css({
                            '-webkit-transition-delay': (index * delay) + 's',
                            'transition-delay': (index * delay) + 's'
                        });
                }
            });
        });
    }

    if (frank.animations.appearingGroups.length) {
        frank.animations.appearingGroups.each(function() {
            var el = $(this),
                initDelay = (parseFloat(el.data('animationInitDelay')) >= 0) ? parseFloat(el.data('animationInitDelay')) : 0,
                delay = (parseFloat(el.data('animationDelay')) >= 0) ? parseFloat(el.data('animationDelay')) : 0.15;
            el.find('[data-appear-group-item]').each(function(index) {
                var item = $(this),
                    delayVal = ((index * delay) + initDelay) + 's';
                item
                    .attr('data-transition-delay', delayVal)
                    .css({
                        'transition-delay': delayVal
                    });
            });
        });
    }

    this.cache.$window.scroll();
};

frank.initSliders = function() {
    if ($('.slideshow-wrapper').length) {
        $('.slideshow-wrapper').each(function() {
            var wrapper = $(this),
                caption = wrapper.find('.slideshow-title'),
                slider = wrapper.find('.slideshow');

            slider.on('afterChange', function(event, slick, currentSlide) {
                var title = $(slick.$slides[currentSlide]).data('title');
                if (title) {
                    caption.html(title)
                }
            });

            slider.slick({
                arrows: true,
                dots: true,
                centerMode: false,
                infinite: false,
                dotsClass: 'custom-paging',
                customPaging: function(slider, i) {
                    return (i + 1) + ' of ' + slider.slideCount;
                }
            });
        });
    }
}

frank.removeOverlay = function() {
    this.cache.$preloaderOverlay.css({
        display: 'none'
    });
};

frank.initScrollTo = function() {
    var self = this;
    this.mainController.scrollTo(function(target) {
        TweenMax.to(window, 0.5, {
            scrollTo: {
                y: target, // scroll position of the target along y axis
                autoKill: true // allows user to kill scroll action smoothly
            },
            ease: Cubic.easeInOut
        });
    });

    $(document).on("click", "a[href^=\\#]", function(e) {
        var id = $(this).attr("href");
        if ($(id).length > 0) {
            e.preventDefault();
            self.mainController.scrollTo(id);
        }
    });
};

jQuery(window).on('load', function($) {
    initLayout();
    initPages();
});


function initLayout() {
    frank.init();
    frank.initScrollTo();
}

function action(action, container) {
    var operation = $(container).data(action);
    if (typeof frank['ani_' + operation] === 'function') {
        frank['ani_' + operation]($(container));
    }
}

function initPages() {
    var page_root = $('.root'),
        next_page_id = page_root.data('pageId'),
        page_init = page_root.data('pageInit'),
        page_in = page_root.data('transitionIn'),
        page_out = page_root.data('transitionOut');

    frank.currentPage = next_page_id;

    if (typeof frank['ani_' + page_init] === 'function') {
        frank['ani_' + page_init](page_root);
    }

    if (typeof frank['ani_' + page_in] === 'function') {
        frank['ani_' + page_in](page_root);
    }

    initRetinaCover();
}