<?php
    session_start();
    require '../config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        if ($password !== $password_confirm) {
            echo "Le password non coincidono!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            try {
                // Prepare the SQL statement
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->bind_param('ss', $username, $hashed_password);
                $stmt->execute();

                echo "Registrazione avvenuta con successo. <a href='login.php'>Clicca qui per effettuare il login</a>";
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) { // Duplicate entry error code
                    echo "Questo username è già in uso. Scegli un altro username.";
                } else {
                    echo "Errore nella registrazione: " . $e->getMessage();
                }
            }
        }
    }
?>

<form method="post" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirm" placeholder="Conferma Password" required>
    <button type="submit">Register</button>
</form>