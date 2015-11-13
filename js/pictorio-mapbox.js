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
        L.mapbox.accessToken = 'pk.eyJ1IjoiZGFuaWVscGVwcGljZWxsaSIsImEiOiJjaWdncnpqOG4wc3IzdzNrbmQzbW40NnRqIn0.608HZWsnmln_Mr6t8JhkEA';
        var map = L.mapbox.map('map', 'danielpeppicelli.gd5pjb3b', {zoomControl:false});
        var markers = {};
        var markersIcons = {};
        var postTypeToIcon = {
            '': 'fa-pencil',
            'video': 'fa-video-camera'
        };

        window.flyTo = function(lon, lat) {
            if (map !== undefined) {
                map.setView([lat,lon], 6);
            }
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

        // Disable drag and zoom handlers.
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();

        // Disable tap handler, if present.
        if (map.tap) map.tap.disable();

    });
}(jQuery));
