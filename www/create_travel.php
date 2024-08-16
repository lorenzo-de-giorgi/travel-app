<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvataggio Dati</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- tage per redirect dopo 5 secondi -->
    <meta http-equiv="refresh" content="5;url=../travels.php">
</head>
<body>
    <div class="container mt-5">
        <?php
        require 'db.php';

        session_start();

        if (!isset($_SESSION['user_id'])) {
            echo "<p class='text-danger'>Errore: utente non autenticato.</p>";
            exit();
        }

        // Recupera i dati del form
        $user_id = $_SESSION['user_id'];
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        echo "<p>Nome: " . htmlspecialchars($name) . "</p>";
        echo "<p>Descrizione: " . htmlspecialchars($description) . "</p>";

        try {
            // Prepara e esegui la query di inserimento
            $sql = "INSERT INTO travels (user_id, name, description) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $name, $description]);

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