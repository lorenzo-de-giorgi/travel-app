<?php

    include __DIR__ . "/Views/header.php";

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

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT id, name FROM travels WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $trips = [];
    while ($row = $result->fetch_assoc()) {
        $trips[] = $row;
    }

    $stmt->close();
    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>I Miei Viaggi</title>
</head>
<body>
    <header>
        <div class="mt-nav">
            <div class="container">
                <nav class="d-flex justify-content-between align-items-center">
                    <img src="./img/logo.png" alt="logo" id="mt-logo">
                    <ul class="list-unstyled">
                        <!-- <li class="mt-3"><a class="mt-delete" href="">Cancella Viaggio</a></li> -->
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <h2>I Miei Viaggi</h2>
    <ul>
        <?php if (!empty($trips)): ?>
            <?php foreach ($trips as $trip): ?>
                <li>
                    <a href="travel.php?id=<?php echo $trip['id']; ?>"><?php echo htmlspecialchars($trip['name']); ?></a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Non hai creato nessun viaggio.</li>
        <?php endif; ?>
    </ul>
    <a href="">Crea Un viaggio</a>
    <form action="./www/create_travel.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nome Viaggio</label>
            <input placeholder="Inserisci il nome del viaggio da creare" type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione Viaggio</label>
            <input placeholder="Inserisci la descrizione del viaggio da creare" type="text" class="form-control" id="description" name="description" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</body>
</html>
