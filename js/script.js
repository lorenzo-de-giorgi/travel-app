import { TOMTOM_API_KEY } from '../config.js';

window.onload = function() {
  var map = tt.map({
    key: `${TOMTOM_API_KEY}`, // Usa i backticks per le template literals
    container: 'map',
    center: [12.4964, 41.9028],
    zoom: 10
  });

  // Funzione per ottenere i marker dal server
  function fetchStages(travelId) {
    return fetch(`api/stages.php?travel_id=${travelId}`) // Usa i backticks per le template literals
      .then(response => response.json())
      .then(data => {
        console.log(data.stages);
        return data.stages;
      })
      .catch(error => {
        console.error('Errore nella fetch:', error);
      });
  }

  // Funzione per aggiungere i marker alla mappa
  function addStagesToMap(stages) {
    stages.forEach(function(stage) {
      // Estraiamo l'ID del viaggio dall'URL
      let urlParams = new URLSearchParams(window.location.search);
      let travelId = urlParams.get('id');

      if (String(stage.travel_id) === travelId) { // Confronta come stringhe
        if (stage.stage_longitude && stage.stage_latitude) { // Verifica i dati
          new tt.Marker().setLngLat([stage.stage_longitude, stage.stage_latitude]).addTo(map);
        } else {
          console.error('Dati di longitude o latitude mancanti:', stage);
        }
      }
    });
  }

  // Estrai l'ID del viaggio dall'URL
  let urlParams = new URLSearchParams(window.location.search);
  let travelId = urlParams.get('id');

  // Recupera i marker dal server e aggiungili alla mappa
  fetchStages(travelId)
    .then(stages => {
      addStagesToMap(stages);
    })
    .catch(error => {
      console.error('Errore nel recupero dei marker:', error);
    });
};