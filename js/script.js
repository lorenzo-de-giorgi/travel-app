import { TOMTOM_API_KEY } from '../config.js';
window.onload = function() {
    var map = tt.map({
        key: `${TOMTOM_API_KEY}`,
        container: 'map',
        center: [12.4964, 41.9028], // Coordinate del centro della mappa (Roma, Italia)
        zoom: 10
    });

    var markers = [
        { lng: 12.4964, lat: 41.9028 }, // Roma
        { lng: 12.3155, lat: 45.4408 }, // Venezia
        { lng: 9.1900, lat: 45.4642 }   // Milano
    ];

    markers.forEach(function(marker) {
        new tt.Marker().setLngLat([marker.lng, marker.lat]).addTo(map);
    });

    var routeOptions = {
        key: `${TOMTOM_API_KEY}`,
        locations: '12.4964,41.9028:12.3155,45.4408:9.1900,45.4642'
    };

    tt.services.calculateRoute(routeOptions).go().then(function(routeData) {
        var geojson = routeData.toGeoJson();
        map.addLayer({
            'id': 'route',
            'type': 'line',
            'source': {
                'type': 'geojson',
                'data': geojson
            },
            'layout': {
                'line-cap': 'round',
                'line-join': 'round'
            },
            'paint': {
                'line-color': '#4a90e2',
                'line-width': 6
            }
        });
    });
};