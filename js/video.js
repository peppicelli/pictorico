(function($) {
    $(document).ready(function() {
        $(".video-overlay-show").click(function( event ) {
            event.preventDefault();
            $(".overlay").removeClass('overlay-hugeinc').addClass('overlay-hugeinc-open overlay-hugeinc');
        });
        $(".overlay-close").click(function( event ) {
            event.preventDefault();
            $(".overlay").removeClass('overlay-hugeinc-open');
        });
    });
}(jQuery));