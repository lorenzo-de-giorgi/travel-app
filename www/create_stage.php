<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvataggio Dati</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php
        $redirect_url = isset($_POST['travel_id']) ? '../travel.php?id=' . htmlspecialchars($_POST['travel_id']) : '../travel.php';
    ?>
    <!-- tage per redirect dopo 5 secondi -->
    <meta http-equiv="refresh" content="5;url=<?php echo $redirect_url; ?>">
</head>
<body>
    <div class="container mt-5">
        <?php
        session_start();
        require 'db.php';
        include 'functions.php';
        $config = include('config.php');
        $apikey = $config['TOMTOM_API_KEY'];


        // Recupera i dati del form
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $travel_id = isset($_POST['travel_id']) ? $_POST['travel_id'] : '';
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        $coordinates = getCoordinatesFromAddress($address);

        echo "<p>Nome: " . htmlspecialchars($name) . "</p>";
        echo "<p>User ID: " . htmlspecialchars($user_id) . "</p>";
        echo "<p>Travel ID: " . htmlspecialchars($travel_id) . "</p>";
        echo "<p>Indirizzo: " . htmlspecialchars($address) . "</p>";
        echo "<p>Descrizione: " . htmlspecialchars($description) . "</p>";
        echo "<p>Latitudine: " . htmlspecialchars($coordinates['latitude']) . "</p>";
        echo "<p>Longitudine: " . htmlspecialchars($coordinates['longitude']) . "</p>";

        try {
            // Prepara e esegui la query di inserimento
            $sql = "INSERT INTO stages (user_id, travel_id, stage_name, stage_address, stage_description, stage_latitude, stage_longitude) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $travel_id, $name, $address, $description, $coordinates['latitude'], $coordinates['longitude']]);

            echo "<p class='text-success'>Dati salvati con successo</p>";
        } catch (PDOException $e) {
            echo "<p class='text-danger'>Errore: " . $e->getMessage() . "</p>";
        }

        // Chiudi la connessione
        $pdo = null;
        ?>
        <p>Verrai reindirizzato alla pagina principale in 5 secondi.</p>
    </div>
</body>
</html>