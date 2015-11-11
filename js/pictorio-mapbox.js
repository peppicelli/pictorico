var map;

function flyTo(lon,lat) {
    if (map !== undefined) {
        map.flyTo({center: [lon, lat], zoom: 9});
    }
}

(function($) {
    $(document).ready( function($) {

        mapboxgl.accessToken = 'pk.eyJ1IjoiZGFuaWVscGVwcGljZWxsaSIsImEiOiJjaWdncnpqOG4wc3IzdzNrbmQzbW40NnRqIn0.608HZWsnmln_Mr6t8JhkEA';

        var tileset = 'mapbox.outdoors';
        map = new mapboxgl.Map({
            container: 'map', // container id
            style: {
                "version": 8,
                "sources": {
                    "simple-tiles": {
                        "type": "raster",
                        "url": "mapbox://" + tileset,
                        "tileSize": 256
                    }
                },
                "layers": [{
                    "id": "simple-tiles",
                    "type": "raster",
                    "source": "simple-tiles",
                    "minzoom": 0,
                    "maxzoom": 22
                }]
            },
            center: [6.6335,46.519833], // starting position
            zoom: 3 // starting zoom
        });



    });
}(jQuery));
