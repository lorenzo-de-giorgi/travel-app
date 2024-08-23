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
        <!-- <link rel="stylesheet" href="../../css/login.css"> -->
        <title>Register</title>
    </head>
    <body>
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <form class="login" method="POST" action="">
                        <h2>Register</h2>
                        <!-- name -->
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input class="login__input" type="text" name="name" placeholder="Name" required>
                        </div>
                        <!-- username -->
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input class="login__input" type="text" name="username" placeholder="Username" required>
                        </div>
                        <!-- email -->
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input class="login__input" type="email" name="email" placeholder="Email" required>
                        </div>
                        <!-- password -->
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input class="login__input" type="password" name="password" placeholder="Password" required>
                        </div>
                        <!-- confirm password -->
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input class="login__input" type="password" name="password_confirm" placeholder="Conferma Password" required>
                        </div>
                        <!-- register -->
                        <button class="button login__submit">
                            <span class="button__text">Register Now</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button>
                        <p class="mt-3">Sei già registrato? <a class="login-a" href="./login.php">Accedi</a></p>			
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>