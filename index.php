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
    <!-- ESEMPIO DI FORM DA SEGUIRE -->
    <!-- <form action="./www/save_data.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="messaggio">Messaggio:</label>
        <textarea id="messaggio" name="messaggio" required></textarea><br><br>

        <input type="submit" value="Invia">
    </form> -->
    <div class="container">
        <div class="row">
            <!-- left card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Crea Nuova Tappa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tappe Attive</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>

            <!-- right card -->
            <div class="col-md-6">
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 class="card-title">Mappa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <!-- <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card image 4">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 4</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>

<?php
    include __DIR__ . "/Views/footer.php"
?>