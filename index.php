<?php
    include __DIR__ . "/Views/header.php";
?>

<header>
    <div class="mt-nav">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <img src="./img/logo.png" alt="logo" id="mt-logo">
                <ul class="list-unstyled">
                    <li class="mt-3"><a class="mt-delete" href="">Cancella Viaggio</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main>
    <form action="./www/save_data.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="messaggio">Messaggio:</label>
        <textarea id="messaggio" name="messaggio" required></textarea><br><br>

        <input type="submit" value="Invia">
    </form>
</main>

<?php
    include __DIR__ . "/Views/footer.php"
?>