
<?php
    $config = include('config.php');
    $apiKey = $config['TOMTOM_API_KEY'];
    $locations = '12.4964,41.9028:12.3155,45.4408:9.1900,45.4642';

    $url = "https://api.tomtom.com/routing/1/calculateRoute/{$locations}/json?key={$apiKey}";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    header('Content-Type: application/json');
    echo $response;