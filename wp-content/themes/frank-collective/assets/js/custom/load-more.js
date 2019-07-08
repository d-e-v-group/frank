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