<?php
    session_start();

    // Controlla se l'utente è loggato
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Connessione al database
    $host = 'localhost';
    $dbname = 'travel-app_db';
    $username_db = 'root'; 
    $password_db = 'root'; 

    $conn = new mysqli($host, $username_db, $password_db, $dbname);

    // Controlla la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // recuper l'id del viaggio
    $trip_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    // Recupera le informazioni del viaggio dal database
    $stmt = $conn->prepare("SELECT id, user_id, name, description FROM travels WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $trip_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();

    if (!$trip) {
        echo "Viaggio non trovato o non autorizzato.";
        exit();
    }

    $stmt->close();
    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($trip['name']); ?></title>
    </head>
    <body>
        <h2><?php echo htmlspecialchars($trip['name']); ?></h2>
        <img src="<?php echo htmlspecialchars($trip['description']); ?>" alt="Mappa del viaggio">
        <!-- Qui puoi aggiungere ulteriori dettagli del viaggio -->
    </body>
</html>