<?php
    // Includi il file con le funzioni
    include './www/functions.php';

    // Indirizzo di test
    $address = 'Via Roma 13, Guidonia Montecelio';

    // Chiama la funzione per ottenere le coordinate
    $coordinates = getCoordinatesFromAddress($address);

    // Verifica e visualizza i risultati
    if ($coordinates) {
        echo 'Latitude: ' . $coordinates['latitude'] . '<br>';
        echo 'Longitude: ' . $coordinates['longitude'];
    } else {
        echo 'Unable to get coordinates.';
    }
