<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvataggio Dati</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- tage per redirect dopo 5 secondi -->
    <meta http-equiv="refresh" content="5;url=../index.php">
</head>
<body>
    <div class="container mt-5">
        <?php
        require 'db.php';

        // Recupera i dati del form
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $messaggio = isset($_POST['messaggio']) ? $_POST['messaggio'] : '';

        echo "<p>Nome: " . htmlspecialchars($nome) . "</p>";
        echo "<p>Email: " . htmlspecialchars($email) . "</p>";
        echo "<p>Messaggio: " . htmlspecialchars($messaggio) . "</p>";

        try {
            // Prepara e esegui la query di inserimento
            $sql = "INSERT INTO test (nome, email, content) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $messaggio]);

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