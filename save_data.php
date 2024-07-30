<?php
    // Dati di connessione al database
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "travel-app_db";

    // Crea connessione
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controlla la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Recupera i dati del form
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $messaggio = $_POST['messaggio'];

    // Prepara e esegui la query di inserimento
    $sql = "INSERT INTO test (name, email, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $messaggio);

    if ($stmt->execute() === TRUE) {
        echo "Dati salvati con successo";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }

    // Chiudi la connessione
    $stmt->close();
    $conn->close();