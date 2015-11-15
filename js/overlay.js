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

        window.displayFlickrGallery = function(flickrGalleryID, title) {
            $("#overlay-title").html(title);
            $(".overlay-container").html("<div class='overlay-container-flickr'><iframe id='iframe' src='//flickrit.com/slideshowholder.php?height=75&size=big&setId=" + flickrGalleryID + "&caption=on&credit=1&thumbnails=0&transition=0&layoutType=responsive&sort=0' scrolling='no' frameborder='0'style='width:100%; height:100%; position: absolute; top:0; left:0;' ></iframe></div>");
            $(".overlay").removeClass('overlay-hugeinc').addClass('overlay-hugeinc-open overlay-hugeinc');
        };

        window.displayVideo = function(youTubeURL, title) {
            $("#overlay-title").html(title);
            $(".overlay-container").html('<iframe width="560" id="video-player" height="315" src="' + youTubeURL + '?enablejsapi=1&showinfo=0" frameborder="0" autoplay="1"></iframe>');
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
        };

        $(".overlay-close").click(function( event ) {
            $(".overlay").removeClass('overlay-hugeinc-open');
            if (player !== undefined) {
                player.stopVideo();
            }
        });

    });
}(jQuery));
