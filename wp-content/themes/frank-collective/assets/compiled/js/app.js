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

jQuery(document).ready(function($) {
    initMobileNav();
    initBannerImg();
    initLocationTab($);
    initFilter($);
    $(window).bind('popstate', function() {
        window.location.href = window.location.href;
    });
});

function initFilter($) {
    if ($('[data-filter-work]').length) {
        var controller = new ScrollMagic.Controller();
        var scene = new ScrollMagic.Scene({
                triggerElement: '#load-more-work', // starting scene, when reaching this element
                triggerHook: 'onEnter',

            })
            .on('enter', function(event) {
                if (event.scrollDirection == 'FORWARD') {
                    loadMoreWorks();
                }
            })
            .addTo(controller);


        var
            filterContentList = $('[data-filter-works-list]'),
            filterDroper = $('[data-filter-work-drop]'),
            loadMoreContainer = $('[data-loadmore-works]'),
            loadMore = $('[data-loadmore-works] a')
        serviceToggle = $('.filter-drop-service'),
            industryToggle = $('.filter-drop-industry'),
            serviceList = $('.filter-list-service'),
            industryList = $('.filter-list-industry'),
            clearFiltersLink = $('.clear-filters'),
            featuredProjects = $('.featured-work');

        function clearFilters() {
            serviceList.hide();
            industryList.hide();
            industryToggle.removeClass('active');
            serviceToggle.removeClass('active');
            $('[data-filter-val]').removeClass('active');
            updateFilter(1);
        }

        clearFiltersLink.on('click', function(e) {
            clearFilters();
        });
        serviceToggle.on('click', function(e) {
            e.preventDefault();
            industryList.hide();
            industryToggle.removeClass('active');
            $(this).toggleClass('active');
            serviceList.slideToggle("slow");
        });

        industryToggle.on('click', function(e) {
            e.preventDefault();
            serviceList.hide();
            serviceToggle.removeClass('active');
            $(this).toggleClass('active');
            industryList.slideToggle("slow");
        });

        loadMore.on('click', function(e) {
            e.preventDefault();
            loadMoreWorks();
            console.log('click load more');
        });


        filterDroper.on('click', '[data-filter-val]', function(e) {
            e.preventDefault();
            $('[data-filter-val]').not($(this)).removeClass('active');
            $(this).toggleClass('active');
            updateFilter(1);
        });

        function loadMoreWorks() {
            var currentPage = filterContentList.attr('data-page') ? filterContentList.attr('data-page') : 1;
            updateFilter(parseInt(currentPage) + 1);
            console.log('load more work');
        }

        function updateFilter(_page) {
            var selectedItems = [];
            var selectedFilterServices = [];
            var selectedFilterIndustry = [];
            var selected = $('[data-filter-val]').filter('.active');
            if (selected.length) {
                selected.each(function() {
                    selectedItems.push($(this).text());
                    if ($(this).data('filterType') === 'industry') {
                        selectedFilterIndustry.push($(this).data('filterVal'));
                    }
                    if ($(this).data('filterType') === 'service') {
                        selectedFilterServices.push($(this).data('filterVal'));
                    }
                });
                featuredProjects.hide();
                clearFiltersLink.show();
            } else {
                featuredProjects.show();
                clearFiltersLink.hide();
            }
            var page = (typeof _page !== 'undefined' && _page > 0) ? _page : 1;

            var request = {
                action: 'fetch_works',
                page: page
            };

            if (selectedFilterServices.length) {
                request.services = selectedFilterServices;
            }

            if (selectedFilterIndustry.length) {
                request.industry = selectedFilterIndustry;
            }

            $.get('/wp-admin/admin-ajax.php',
                request,
                function(response) {
                    if (response.status === 'success') {
                        var parent = $('[data-filter-works-list]');
                        parent.attr('data-page', page);
                        if (parent.length) {
                            parent.empty();
                            parent.html(response.works);
                        }

                        $('.loading-spinner').css({
                            display: 'none'
                        });

                        if (response.loadMore) {
                            loadMoreContainer.show();
                        } else {
                            loadMoreContainer.hide();
                        }
                    }
                });
        }
    }
}

function initLocationTab($) {
    if ($('.locations-switcher').length) {
        $('.locations-switcher .location-item').slice(1).css({
            display: 'none'
        });
        $('.location-switcher-nav a').on('click', function(e) {
            e.preventDefault();
            var el = $(this),
                target = el.data('href');
            $('.locations-switcher .location-item').not($(target)).css({
                display: 'none'
            });
            $(target).css({
                display: 'block'
            })
        });
    }
}

function initMobileNav() {
    var navopener = jQuery('.nav-opener'),
        navwrap = jQuery('.nav-pannel'),
        links = navwrap.find('a:not(.hasdrop-a)'),
        navactive = 'nav-active';

    navopener.click(function(e) {
        e.preventDefault();
        jQuery('body').toggleClass(navactive);
    });

    links.click(function() {
        jQuery('body').removeClass(navactive);
    });

    jQuery('html').on('click touchstart pointerdown MSPointerDown', function(e) {
        var target = jQuery(e.target);
        if (!target.closest(navopener).length && !target.closest(navwrap).length) {
            jQuery('body').removeClass(navactive);
        }
    });
}


// Retina Cover
function initRetinaCover() {
    jQuery('.bg-stretch').retinaCover();
}

function initBannerImg() {
    jQuery('.banner-office .bg-img').hide();
    var activetab = jQuery('.banner-office-links .active a').attr('href');
    jQuery(activetab).show();

    jQuery('.banner-office-links a').click(function() {
        jQuery('.banner-office-links li').removeClass('active');
        jQuery(this).parent().addClass('active');
        var currentTab = jQuery(this).attr('href');
        jQuery('.banner-office .bg-img').fadeOut();
        jQuery(currentTab).fadeIn();
        return false;
    });
}
jQuery(document).ready(function($){
	jQuery('.btn-load-more-ajax a').on('click', function(event){
        event.preventDefault();
        frankLoadMore( jQuery(event.currentTarget) );
    });

    function frankLoadMore(btn) {
        var contentTarget = btn.parent().data('target'),
            appendTo = btn.parent().data('append-to'),
            loadMore = btn.parent().data('load-more');

        jQuery.get(btn.attr('href'), function(data) {
            jQuery( appendTo ).append(jQuery(data).find( contentTarget ));
            var nextBtn = jQuery(data).find( loadMore ).attr('href');
            nextBtn ? btn.attr('href',nextBtn) : btn.parent().hide();
        });
    }
});
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
    self.animations.initScrollNav();
    self.animations.initScrollNavDark();
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
frank.ani_culture_2_init = function (root) {
  var self = this;
  this.pages['culture'] = {
      root: root,
      // controller: new ScrollMagic.Controller(),
  };

  let desktopInitialized = false;

  function init_culture_desktop_bg() {
    if ($(window).width() > 1023) {
      if (!desktopInitialized) {
        $('.culture-item').each(function(){
          var src = $(this).data('src');
          $(this).attr('src', src);
        });
        desktopInitialized = true;
        animate_culture_desktop_bg();      
      }    
    }
  }

  function animate_culture_desktop_bg() {
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
  }
  
  $(document).ready(function(){
    init_culture_desktop_bg();
  })

  $(window).resize(function(){
    init_culture_desktop_bg();
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

frank.ani_culture_init = function (root) {
    var self = this;
    this.pages['culture'] = {
        root: root,
        controller: new ScrollMagic.Controller(),
        // hero: root.find('.case-study-hero'),
        // content: root.find('.case-study-content'),
        cultureSection: root.find('.culture-section'),
        teamSection: root.find('.team-section'),
        introSection: root.find('.team-section .intro'),
        // bannerImage: root.find('.banner > *'),
        animatedBackground: root.find('.work-animated-background')
    };

    if(this.pages['culture'].animatedBackground.length){
        var timelineBackground = new TimelineMax()
          .to(this.pages['culture'].animatedBackground, 1, {backgroundColor: '#ffffff', ease: Power1.easeNone});

        new ScrollMagic.Scene({
            triggerElement: this.pages['culture'].teamSection,
            triggerHook: 'onEnter',
            duration: 300
        })
          .setTween(timelineBackground)
          .addTo(this.pages['culture'].controller);
    }

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

frank.ani_culture_in = function (root) {
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

/*
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
*/
frank.ani_homepage_init = function(root) {
    this.pages['homepage'] = {
        root: root,
        background: root.find('#homepage-background'),
        nav: root.find('.nav-links'),
        links: root.find('.nav-links a')
    };
    this.cache.$header.addClass('nav-hidden');
    TweenLite.set(this.cache.$header, { opacity: 0 });
    TweenLite.set(this.pages['homepage'].background, { opacity: 0 });
    TweenLite.set(this.pages['homepage'].links, { opacity: 0, visibility: 'hidden' });
};

frank.ani_homepage_in = function(root) {
    this.removeOverlay();
    this.cache.$header.removeClass('nav-hidden');
    new TimelineMax()
        .to(this.pages['homepage'].background, 0.4, { opacity: 1, ease: Power1.easeOut }, "-=0.2")
        .staggerFromTo(this.pages['homepage'].links, 0.4, { opacity: 0, x: -40 }, { opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut }, 0.15, "-=0.2")
        .to(this.cache.$footer, 0.4, { opacity: 1, y: 0, ease: Power1.easeOut }, "-=0.4") //Expo.easeOut
    ;
};

frank.ani_homepage_out = function(root) {
    this.cache.$header.addClass('nav-hidden');
    new TimelineMax()
        .to(this.pages['homepage'].background, 0.4, { opacity: 1, ease: Power1.easeOut }, "-=0.2")
        .staggerTo(this.pages['homepage'].links, 0.4, { opacity: 0, x: -40, ease: Power1.easeOut }, 0.15, "-=0.2")
        .to(this.cache.$footer, 0.4, { opacity: 0, y: 20, ease: Power1.easeOut }, "-=0.4") //Expo.easeOut
    ;
};

$('.hp-slider').slick({
    adaptiveHeight: false,
    infinite: true,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    dots: true,
    pauseOnHover: false,
    customPaging: function(slick, index) {
        var currSlide = slick.$slides.get(index);
        // add 'white' class to pagination when needed to match slide text choice; add numbers as pagination
        for (var i = 0; i < currSlide.children.length; i++) {
            if (currSlide.children[i].classList.contains('hp-slide-text-white')) {
                $('.slick-dots').ready(function() {
                    document.querySelector('.slick-dots').classList.add('white');
                    document.querySelector('header').classList.add('hp-white-text');
                    document.querySelector('.slick-next').classList.add('white');
                    document.querySelector('.slick-prev').classList.add('white');
                });
            }
        }
        return '<span>' + (index + 1) + '</span>';
    }
});

//change pagination color if necessary
$('.hp-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    //use currentSlide (index) to get slide html element  
    var nextSlide = slick.$slides.get(nextSlide);
    if (nextSlide.querySelector('video')) {
        // nextSlide.querySelector('video').pause();
        nextSlide.querySelector('video').currentTime = 0;
        nextSlide.querySelector('video').pause();
    }

    for (var i = 0; i < nextSlide.children.length; i++) {
        if (!nextSlide.children[i].classList.contains('hp-slide-text-white')) {
            document.querySelector('.slick-dots').classList.remove('white');
            document.querySelector('.slick-next').classList.remove('white');
            document.querySelector('.slick-prev').classList.remove('white');
            document.querySelector('header').classList.remove('hp-white-text');
        } else {
            document.querySelector('.slick-dots').classList.add('white');
            document.querySelector('.slick-next').classList.add('white');
            document.querySelector('.slick-prev').classList.add('white');
            document.querySelector('header').classList.add('hp-white-text');
        }
    }

});
//if video, play afterChange
$('.hp-slider').on('afterChange', function(event, slick, currentSlide, nextSlide) {
    //use currentSlide (index) to get slide html element  
    var currSlide = slick.$slides.get(currentSlide);
    if (currSlide.querySelector('video')) {
        currSlide.querySelector('video').play();
    }
});

$(document).ready(function() {
    loadSlideAssets();
});

// if mobile, show mobile versions of slider img/video from CMS
// show mobile img/vid div if .nav-opener display=block
function loadSlideAssets() {

    var mAssets = document.querySelectorAll('.mob-asset');
    var dAssets = document.querySelectorAll('.dt-asset');

    if ($('.nav-opener').css('display') == 'block') {
        dAssets.forEach(asset => {
            asset.style.display = 'none';
            asset.setAttribute('src', '');
        });

        mAssets.forEach(asset => {
            asset.setAttribute('src', asset.dataset.mobileAsset);
        });

    } else {

        mAssets.forEach(asset => {
            asset.style.display = 'none';
            asset.setAttribute('src', '');
        });

        dAssets.forEach(asset => {
            asset.setAttribute('src', asset.dataset.desktopAsset);
        });

    }

    //TODO: on resize, remove all src first and redefine
}
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
frank.getWorkCardPosition = function(el) {
    var item = $(el),
        position = item.data('position');
    if (position) {
        var itemWidth = item.width(),
            descWidth = item.find('.desc').width(),
            imageWidth = itemWidth - descWidth,
            imageResizedWidth = imageWidth * 0.75,
            imageGap = (imageWidth - imageResizedWidth) / 4;
        if (position === 'left') {
            return -descWidth - imageGap;
        } else {
            return imageGap;
        }
    } else {
        return 0;
    }
};

frank.getWorkCardDescPosition = function(el) {
    var item = $(el),
        position = item.data('position');

    return (position === 'left') ? 400 : 200
};

frank.ani_works_2_init = function(root) {
    var self = this;
    this.pages['works'] = {
        root: root,
        backgrounds: [],
        works: root.find('.work-list .work-item'),
        worksLeft: root.find('.work-list .work-item.position-left'),
        worksRight: root.find('.work-list .work-item.position-right'),
       // controller: new ScrollMagic.Controller(),
        workSection: root.find('.work-section'),
        animatedBackground: root.find('.work-animated-background'),
        onResize: function(e) {
            var workHeight = 0;
            self.pages['works'].works.each(function() {
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

            self.pages['works'].works.each(function(index) {
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

    this.pages['works'].works.each(function() {
        var $this = $(this);
        self.pages['works'].backgrounds.push($this.data('backgroundColor'));
    });

    this.pages['works'].timelines = [];

    this.pages['works'].onResize();
    window.addEventListener('resize', this.pages['works'].onResize);
    TweenLite.set(this.cache.$footer, { opacity: 0, y: 20 });
    TweenLite.set(this.pages['works'].worksLeft.slice(1), { opacity: 0, x: 50 });
    TweenLite.set(this.pages['works'].worksRight, { opacity: 0, x: -50 });
};

frank.ani_works_2_out = function(parent) {
    return new Promise(function(resolve, reject) {
        // var el = parent.find('.featured-project'),
        var el = find('.view-case-study'),
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
                'background-image': 'url(' + el.data('image') + ')'
            });

        $('.main').append(linker);

        var overlay = $('<div/>').addClass('work-overlay');

        $('#wrapper').append(overlay);
        TweenLite.set(overlay, { xPercent: 100, opacity: 1 });

        frank.cache.$header.addClass('nav-hidden');
        el.css({
            visibility: 'hidden'
        });

        new TimelineMax({
                onComplete: function() {
                    resolve();
                }
            })
            .to(parent.parents('.work-list'), 0.7, { opacity: 0, ease: Power0.easeNone })
            .to(linker, 0.7, { left: 0, top: 0, width: frank.cache.clientWidth, height: frank.cache.clientHeight, scale: 1.04, zIndex: 999, ease: Power0.easeNone }, "-=0.5")
            .to(overlay, 0.6, { xPercent: 0, ease: frank.easeBezier });
    });
};

frank.ani_works_2_in = function(root) {
    this.removeOverlay();
    frank.cache.$header.removeClass('nav-hidden');
    new TimelineMax()
        .staggerTo(this.pages['works'].works, 0.4, { opacity: 1, x: 0, visibility: 'visible', ease: Power1.easeOut }, 0.15, 0.3)
        .to(this.cache.$footer, 0.4, { opacity: 1, y: 0, ease: Power1.easeOut }, "-=0.4") //Expo.easeOut
    ;
    this.initUI();
};

// Scroll to top
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > ($(window).height() * 2)) {
        $('#scrollToTop').fadeIn();
    } else {
        $('#scrollToTop').fadeOut();
    }
});

$("#scrollToTop a").click(function(event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
});
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

//# sourceMappingURL=app.js.map
