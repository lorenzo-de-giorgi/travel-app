<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellazione Tappa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- tage per redirect dopo 5 secondi -->
    <meta http-equiv="refresh" content="5;url=../index.php">
</head>
<body>
    <div class="container mt-5">
        <?php
            require 'db.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['id']) && !empty($_POST['id'])) {
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
        
                    // 2. ID del record da cancellare
                    $id = intval($_POST['id']);
        
                    // 3. Creazione della query di cancellazione
                    $sql = "DELETE FROM stages WHERE id = ?";
        
                    // Preparare la query
                    $stmt = $conn->prepare($sql);
        
                    if ($stmt === false) {
                        die("Errore nella preparazione della query: " . $conn->error);
                    }
        
                    // Bind dei parametri
                    $stmt->bind_param("i", $id);
        
                    // 4. Eseguire la query
                    if ($stmt->execute()) {
                        echo "Record cancellato con successo";
                    } else {
                        echo "Errore nella cancellazione del record: " . $stmt->error;
                    }
        
                    // 5. Chiudere la connessione
                    $stmt->close();
                    $conn->close();
                } else {
                    echo "ID non valido.";
                }
            } else {
                echo "Richiesta non valida.";
            }
        ?>
        <p>Verrai reindirizzato alla pagina principale in 5 secondi.</p>
    </div>
</body>
</html>