<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellazione Tappa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php
    $redirect_url = '../index.php'; // URL di default se qualcosa va storto

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !empty($_POST['id'])) {
        // 1. Connessione al database
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "travel-app_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Controllo della connessione
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // ID del record da cancellare
        $id = intval($_POST['id']);

        // Recupera il travel_id prima di cancellare la tappa
        $stmt = $conn->prepare("SELECT travel_id FROM stages WHERE id = ?");
        if ($stmt === false) {
            die("Errore nella preparazione della query: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $travel_id = $row['travel_id'];
            // Costruisci l'URL di reindirizzamento usando il travel_id
            $redirect_url = '../travel.php?id=' . htmlspecialchars($travel_id);

            // Creazione della query di cancellazione
            $sql = "DELETE FROM stages WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Errore nella preparazione della query: " . $conn->error);
            }

            $stmt->bind_param("i", $id);

            // Eseguire la query
            if ($stmt->execute()) {
                echo "<p class='text-success'>Record cancellato con successo</p>";
            } else {
                echo "<p class='text-danger'>Errore nella cancellazione del record: " . $stmt->error . "</p>";
            }

            // Chiudere la connessione
            $stmt->close();
            $conn->close();
        } else {
            echo "<p class='text-danger'>Tappa non trovata.</p>";
        }
    } else {
        echo "<p class='text-danger'>ID non valido o richiesta non valida.</p>";
    }
    ?>
    <!-- Redirezione automatica dopo 5 secondi -->
    <meta http-equiv="refresh" content="0;url=<?php echo $redirect_url; ?>">
</head>
<body>
    <div class="container mt-5">
        <p>Verrai reindirizzato alla pagina del viaggio in 5 secondi.</p>
    </div>
</body>
</html>