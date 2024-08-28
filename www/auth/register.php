<?php
    session_start();

    include "../../Views/header.php";

    require '../db.php';
    require '../config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        if ($password !== $password_confirm) {
            echo "Le password non coincidono!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $servername = "localhost";
            $username_db = "root";
            $password = "root";
            $dbname = "travel-app_db";

            // creo la connessione
            $conn = new mysqli($servername, $username_db, $password, $dbname);

            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }

            try {
                // Prepare the SQL statement
                $stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('ssss', $name, $username, $email, $hashed_password);
                $stmt->execute();

                echo "Registrazione avvenuta con successo. <a href='login.php'>Clicca qui per effettuare il login</a>";
                // dopo la registrazione reinderizza alla pagina di login
                header("Location: login.php");
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) { // Duplicate entry error code
                    echo "Questo username è già in uso. Scegli un altro username.";
                } else {
                    echo "Errore nella registrazione: " . $e->getMessage();
                }
            }

            $stmt->close();
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Register</title>
    </head>
    <body>
        <div class="container">
            <a href="../../homepage.php" class="mt-3 btn btn-primary"><i class="fa-solid fa-house"></i> Homepage</a>
            <div class="mt-5">
                <form method="POST" action="">
                    <h2 class="text-center mb-5">Form Di Registrazione</h2>
                    <div class="text-center row g-3">
                        <!-- name -->
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="name" placeholder="Name" required>
                        </div>
                        <!-- username -->
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                        </div>
                        <!-- email -->
                        <div class="col-12">
                            <input class="form-control" type="email" name="email" placeholder="Email" required>
                        </div>
                        <!-- password -->
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <!-- confirm password -->
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password_confirm" placeholder="Conferma Password" required>
                        </div>
                        <!-- register -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Registrati</button>
                        </div>
                        <p class="mt-3">Sei già registrato? <a class="login-a" href="./login.php">Accedi</a></p>
                    </div>			
                </form>
            </div>
        </div>
    </body>
</html>