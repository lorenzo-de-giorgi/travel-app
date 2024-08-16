<?php
session_start();

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

            header("Location: trips.php");
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
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>