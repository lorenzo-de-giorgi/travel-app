<?php
    $config = include('config.php');
    // funzione per recuperare le coordinate (latitudine e longitudine) partendo dall'indirizzo
    function getCoordinatesFromAddress($address){
        $config = include('config.php');
        $apiKey = $config['TOMTOM_API_KEY'];
        $encodedAddress = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$encodedAddress}.json?&countrySet=IT&key={$apiKey}";

        $ch = curl_init();
        // imposto l'URL per la richiesta
        curl_setopt($ch, CURLOPT_URL, $url);
        // restituisco il trasferimento come stringa
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //disabilito la verifica SSL dell' host
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // disabilito il controllo SSL del peer
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // eseguo la richiesta cURL
        $response = curl_exec($ch);

        // verifico gli errori nella richiesta
        if(curl_errno($ch)){
            echo 'Error:' . curl_error($ch);
        }

        // chiudo la sessione
        curl_close($ch);

        // decodifico la risposta JSON
        $data = json_decode($response, true);

        // verifico i risultati validi
        if(isset($data['results'][0]['position'])){
            $latitude = $data['results'][0]['position']['lat'];
            $longitude = $data['results'][0]['position']['lon'];
            // ritorno un array contenente $latitude e $longitude
            return compact('latitude', 'longitude');
        } else {
            return null;
        }
    }

    // funzione per connettersi al Database

    function getDbConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "travel-app_db";

        // creo la connessione
        $conn = new mysqli($servername, $username, $password, $dbname);

        // verifico la connessione
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }