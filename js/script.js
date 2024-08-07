import { TOMTOM_API_KEY } from '../config.js';

window.onload = function() {
    var map = tt.map({
        key: `${TOMTOM_API_KEY}`,
        container: 'map',
        center: [12.4964, 41.9028], // Coordinate del centro della mappa (Roma, Italia)
        zoom: 10
    });

    // Funzione per ottenere i marker dal server
    function fetchStages() {
        return fetch('api/stages.php') // Supponendo che l'API si trovi a questo endpoint
            .then(response => response.json())
            .then(data => {
                return data.stages; // Adatta questa linea in base al formato della risposta JSON
            });
    }

    // Funzione per aggiungere i marker alla mappa
    function addStagesToMap(stages) {
        stages.forEach(function(stage) {
            new tt.Marker().setLngLat([stage.stage_longitude, stage.stage_latitude]).addTo(map);
        });
    }

    // Funzione per tracciare l'itinerario tra le tappe e fare il focus sull'itinerario
    function drawRouteAndFocus(stages) {
        if (stages.length > 2) {
            const waypoints = stages.map(stage => [stage.stage_longitude, stage.stage_latitude]);
            const routeOptions = {
                key: TOMTOM_API_KEY,
                locations: waypoints,
                travelMode: 'car'
            };

            tt.services.calculateRoute(routeOptions)
                .then(function(response) {
                    const geojson = response.toGeoJson();
                    map.addLayer({
                        id: 'route',
                        type: 'line',
                        source: {
                            type: 'geojson',
                            data: geojson
                        },
                        paint: {
                            'line-color': '#4a90e2',
                            'line-width': 6
                        }
                    });

                    // Fare il focus sull'itinerario
                    const bounds = new tt.LngLatBounds();
                    waypoints.forEach(function(point) {
                        bounds.extend(point);
                    });
                    map.fitBounds(bounds, { padding: 50 });
                })
                .catch(function(error) {
                    console.error('Errore nel calcolo del percorso:', error);
                });
        } else {
            console.error('Errore: Il numero di tappe deve essere maggiore di 2 per tracciare un itinerario.');
        }
    }

    // Recupera i marker dal server, aggiungili alla mappa e traccia l'itinerario
    fetchStages().then(stages => {
        addStagesToMap(stages);
        drawRouteAndFocus(stages);
    }).catch(error => {
        console.error('Errore nel recupero dei marker:', error);
    });
};