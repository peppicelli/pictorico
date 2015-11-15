function waitAndAddMarker(lon, lat, id, postType){
    if(typeof window.addMarker !== "undefined"){
        window.addMarker(lon, lat, id, postType);
    }
    else{
        setTimeout(function(){
            waitAndAddMarker(lon, lat, id, postType);
        },250);
    }
}

(function($) {
    $(document).ready( function($) {

        window.flyTo = function(lon, lat, zoom) {
            zoom = zoom || 6;
            if (map !== undefined) {
                map.setView([lat,lon], zoom);
            }
        };

        window.resetMap = function() {
            flyTo(20, 40, 2);
        };

        window.activateMarker = function(id) {
            changeIconColor(id, '#FFFFFF', 'red');
        };

        window.deactivateMarker = function(id) {
            changeIconColor(id, '#FFFFFF', 'blue');
        };

        function changeIconColor(id, color, bgcolor) {
            markersIcons[id].options.iconColor = color;
            markersIcons[id].options.markerColor = bgcolor;
            markers[id].setIcon(markersIcons[id]);
        }

        window.addMarker = function(lon, lat, id, postType) {

            var icon = L.AwesomeMarkers.icon({
                prefix: 'fa',
                icon: postTypeToIcon[postType],
                iconColor: '#FFFFFF'
            });

            var marker = L.marker([lat,lon],
                {icon: icon}
            );

            marker.addTo(map);
            markers[id] = marker;
            markersIcons[id] = icon;
        };

        L.mapbox.accessToken = mapboxAccessToken;
        var map = L.mapbox.map('map', mapboxMapID, {zoomControl:false});
        resetMap();
        var markers = {};
        var markersIcons = {};
        var postTypeToIcon = {
            '': 'fa-pencil',
            'video': 'fa-video-camera',
            'gallery': 'fa-camera-retro'
        };

        // Disable drag and zoom handlers.
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();

        // Disable tap handler, if present.
        if (map.tap) map.tap.disable();

    });
}(jQuery));
