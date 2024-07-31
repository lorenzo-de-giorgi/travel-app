<?php
    require 'db.php';

    // Recupera i dati del form
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $messaggio = $_POST['messaggio'];

    try {
        // Prepara e esegui la query di inserimento
        $sql = "INSERT INTO test (nome, email, content) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $messaggio]);

        echo "Dati salvati con successo";
    } catch (PDOException $e) {
        echo "Errore: " . $e->getMessage();
    }

    // Chiudi la connessione
    $pdo = null;
