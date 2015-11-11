(function($) {
    $(document).ready(function() {
        var player;

        function onYoutubeReady() {
            player = new YT.Player("video-player",
                { events: { 'onReady' : onPlayerReady}});
        }

        function onPlayerReady() {
            player.playVideo();
        }

        $(".video-overlay-show").click(function( event ) {
            event.preventDefault();
            var youTubeURL = $(this).attr('href');
            var title = $(this).attr('title');
            $("#video-title").html(title);
            $(".video-container").html('<iframe width="560" id="video-player" height="315" src="' + youTubeURL + '?enablejsapi=1&showinfo=0" frameborder="0" autoplay="1"></iframe>');

            // Lazy load youtube API if not yet available
            if(typeof YT === "object") {
                onYoutubeReady();
            }
            else {
                $.getScript("//www.youtube.com/player_api", function () {
                    var api_ready_interval = setInterval(function () {
                        if (typeof YT === "object") {
                            onYoutubeReady();
                            clearInterval(api_ready_interval);
                        }
                    }, 500);
                });
            }

            $(".overlay").removeClass('overlay-hugeinc').addClass('overlay-hugeinc-open overlay-hugeinc');
        });

        $(".overlay-close").click(function( event ) {
            $(".overlay").removeClass('overlay-hugeinc-open');
            player.stopVideo();
        });

    });
}(jQuery));
