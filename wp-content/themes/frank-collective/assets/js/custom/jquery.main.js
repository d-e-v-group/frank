

jQuery(document).ready(function($){
    initMobileNav();
    // initRetinaCover();
    initBannerImg();
    initLocationTab($);
    initFilter($);
    $(window).bind('popstate', function(){
        window.location.href = window.location.href;
    });
});

function initFilter($) {
    if($('[data-filter-work]').length){
        var
            filterParent = $('[data-filter-work]'),
            filterContentList = $('[data-filter-works-list]'),
            filterSelect = $('[data-filter-work-select]'), // THE INDICATOR
            filterDroper = $('[data-filter-work-drop]'), // WRAPPER 
            loadMoreContainer = $('[data-loadmore-works]'),
            loadMore = $('[data-loadmore-works] a')
            serviceToggle = $('.filter-drop-service'),
            industryToggle = $('.filter-drop-industry'),
            serviceList = $('.filter-list-service'),
            industryList = $('.filter-list-industry'),
            clearFiltersLink = $('.clear-filters'),
            featuredProjects = $('.featured-work')
        ;
        function hideFilterLists() {
            serviceList.hide();
            industryList.hide();
        }
        serviceToggle.on('click', function (e) {
            e.preventDefault();
            industryList.hide();
            serviceList.slideToggle("slow");
        });

        industryToggle.on('click', function (e) {
            e.preventDefault();
            serviceList.hide();
            industryList.slideToggle("slow");
        });

        loadMore.on('click', function (e) {
            e.preventDefault();
            var currentPage = filterContentList.attr('data-page') ? filterContentList.attr('data-page') : 1;
            updateFilter(parseInt(currentPage) + 1);
        });

        // filterSelect.on('click', function (e) {
        //     e.preventDefault();
        //     filterDroper.slideToggle("slow");
        // });

        filterDroper.on('click', '[data-filter-val]', function (e) {
            e.preventDefault();
            console.log('clicking on one');
            $('[data-filter-val]').not($(this)).removeClass('active');
            $(this).toggleClass('active');
            updateFilter(1);
            //filterDroper.slideUp(400);
        });

        // filterSelect.parent().find('.close').on('click', function (e) {
        //     e.preventDefault();
        //     filterSelect.parent().removeClass('filter-active');
        //     $('[data-filter-val]').removeClass('active');
        //     updateFilter(1);
        //     filterDroper.slideUp(400);
        // });

        function updateFilter(_page) {
            console.log('updating the filter');
            var selectedItems = [];
            var selectedFilterServices = [];
            var selectedFilterIndustry = [];
            var selected = $('[data-filter-val]').filter('.active');
            if(selected.length){
                selected.each(function () {
                    selectedItems.push($(this).text());
                    if($(this).data('filterType') === 'industry'){
                        selectedFilterIndustry.push($(this).data('filterVal'));
                    }
                    if($(this).data('filterType') === 'service'){
                        selectedFilterServices.push($(this).data('filterVal'));
                    }
                });
                // filterSelect.text(selectedItems.join(", "));
                // filterSelect.parent().addClass('filter-active');
                featuredProjects.hide();
                console.log('categeory selected', selected);
            } else {
                featuredProjects.show();
                console.log('no category selected');
                // filterSelect.text('All');
                // filterSelect.parent().removeClass('filter-active');
            }
            var page = (typeof _page !== 'undefined' && _page > 0) ? _page : 1;

            var request = {
                action: 'fetch_works',
                page: page
            };

            if(selectedFilterServices.length){
                request.services = selectedFilterServices;
            }

            if(selectedFilterIndustry.length){
                request.industry = selectedFilterIndustry;
            }

            $.get('/fc/frank/wordpress/wp-admin/admin-ajax.php',
              request,
              function (response) {
                  if(response.status === 'success'){
                      var parent = $('[data-filter-works-list]');
                      parent.attr('data-page', page);
                      if(parent.length){
                          parent.empty();
                          parent.html(response.works);
                      }

                      $('.loading-spinner').css({
                          display: 'none'
                      });

                      if(response.loadMore){
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
    if($('.locations-switcher').length){
        $('.locations-switcher .location-item').slice(1).css({
            display: 'none'
        });
        $('.location-switcher-nav a').on('click', function (e) {
            e.preventDefault();
            var el = $(this),
                target = el.data('href');
            $('.locations-switcher .location-item').not($(target)).css({
                display:'none'
            });
            $(target).css({
                display: 'block'
            })
        });
    }
}

function initMobileNav() {
    var navopener = jQuery('.nav-opener'),
    navwrap   = jQuery('.nav-pannel'),
    links     = navwrap.find('a:not(.hasdrop-a)'),
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
        if(!target.closest(navopener).length && !target.closest(navwrap).length) {
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

    jQuery('.banner-office-links a').click(function(){
        jQuery('.banner-office-links li').removeClass('active');
        jQuery(this).parent().addClass('active');
        var currentTab = jQuery(this).attr('href');
        jQuery('.banner-office .bg-img').fadeOut();
        jQuery(currentTab).fadeIn();
        return false;
    });
}