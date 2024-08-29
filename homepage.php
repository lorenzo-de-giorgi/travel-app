<?php
    include __DIR__ . "./Views/header.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link grity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/homepage.css">
    <title>Homepage</title>
</head>

<div class="mt-nav">
    <nav class="container navbar navbar-expand-lg d-flex justify-content-between align-items-center">
        <img src="./img/logo.png" alt="logo" id="mt-logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="mt-3 me-3"><a class="mt-login-btn" href="./www/auth/login.php">Login</a></li>
            <li class="me-3 mt-3"><a class="mt-register-btn" href="./www/auth/register.php">Register</a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- <header>
    <div class="mt-nav">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <img src="./img/logo.png" alt="logo" id="mt-logo">
                <ul class="list-unstyled d-flex">
                    <li class="mt-3 me-3"><a class="mt-login-btn" href="./www/auth/login.php">Login</a></li>
                    <li class="me-3 mt-3"><a class="mt-register-btn" href="./www/auth/register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header> -->

<main>
    <header>
        <h1 class="text-center mt-4">Benvenuti su MyTravel</h1>
        <p class="mt-3">La tua app per pianificare e gestire i tuoi viaggi in modo semplice e intuitivo!</p>
    </header>

    <section class="mt-4">
        <h2 class="text-center">Cos'è MyTravel?</h2>
        <p class="mt-3">MyTravel è un'applicazione che ti permette di organizzare i tuoi viaggi in pochi semplici passi. Con MyTravel, puoi creare itinerari personalizzati, aggiungere tappe, cancellarle se necessario, e segnare come completate le attività che hai portato a termine.</p>
    </section>

    <section class="mt-4">
        <h2>Caratteristiche principali</h2>
        <ul class="centered-list">
            <li class="mt-3"><strong>Registrazione Facile:</strong> Crea un account in pochi minuti e inizia subito a pianificare i tuoi viaggi.</li>
            <li class="mt-3"><strong>Crea Viaggi Personalizzati:</strong> Aggiungi, modifica e rimuovi tappe in base alle tue preferenze.</li>
            <li class="mt-3"><strong>Gestisci le Tappe:</strong> Puoi facilmente cancellare le tappe che non ti interessano più o segnare come completate quelle che hai già visitato.</li>
            <li class="mt-3"><strong>Interfaccia Intuitiva:</strong> L'interfaccia user-friendly rende la gestione dei tuoi viaggi un'esperienza piacevole.</li>
        </ul>
    </section>

    <section>
        <h2>Come funziona?</h2>
        <p>Seguire i seguenti passi per iniziare a usare ViaggiPlan:</p>
        <ul class="centered-list">
            <li><strong>Registrati:</strong> Crea un account inserendo i tuoi dati personali.</li>
            <li><strong>Crea un nuovo viaggio:</strong> Inserisci la destinazione, le date e inizia ad aggiungere tappe.</li>
            <li><strong>Aggiungi tappe:</strong> Puoi inserire dettagli come luoghi da visitare, ristoranti, attività e altro.</li>
            <li><strong>Gestisci il tuo itinerario:</strong> Modifica, cancella o segna come completate le tappe del tuo viaggio in qualsiasi momento.</li>
        </ul>
    </section>

    <section class="mt-4">
        <h2>Inizia oggi stesso!</h2>
        <p>Non aspettare! Registrati ora e inizia a pianificare il tuo prossimo viaggio con MyTravel.</p>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
    include __DIR__ . "./Views/footer.php";
?>