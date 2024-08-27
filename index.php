<?php
    session_start();

    // controllo che l'utente sia loggato
    if(!isset($_SESSION['user_id'])){
        // se l'utente non è loggato rimanda al login
        header("Location: homepage.php");
        exit();
    } else {
        // se l'utente è loggato rimanda alla pagina dei viaggi
        header("Location: travels.php");
        exit();
    }