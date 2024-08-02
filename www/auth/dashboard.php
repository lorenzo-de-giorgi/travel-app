<?php
    session_start();
    require '../config.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Recupera l'username dal database
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
?>

<h1>Login avvenuto con successo, <?php echo htmlspecialchars($username); ?>!</h1>

<a href="logout.php">Logout</a>