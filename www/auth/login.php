<?php
    session_start();

    include "../../Views/header.php";

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepara la query SQL per prevenire SQL injection
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // Se l'utente esiste
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // Verifica la password
            if (password_verify($password, $hashed_password)) {
                // Login riuscito
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                header("Location: ../../travels.php");
                exit();
            } else {
                // Password errata
                $error = "Username o password non corretti.";
            }
        } else {
            // Username non trovato
            $error = "Username o password non corretti.";
        }

        $stmt->close();
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href=""> -->
        <title>Accesso</title>
    </head>
    <body>
        <div class="container">
            <a href="../../homepage.php" class="mt-3 btn btn-primary"><i class="fa-solid fa-house"></i> Homepage</a>
            <div class="mt-5">
                <form method="POST" action="">
                    <h2 class="text-center mb-5">Form Di Accesso</h2>
                    <div class="text-center row g-3">
                        <!-- username -->
                        <div class="col-12">
                            <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                        </div>
                        <!-- password -->
                        <div class="col-12">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                        <!-- login button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Accedi</button>
                        </div>
                        <p class="mt-5">Non sei ancora registrato? <a href="./register.php">Registrati</a></p>	
                    </div>		
                </form>
            </div>
        </div>
    </body>
</html>