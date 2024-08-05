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
    <div class="container mt-5">
        <div class="row">
            <!-- left card -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Crea Nuova Tappa</h5>
                        <p class="card-text">
                            <form action="./www/save_data.php" method="POST">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tappe Attive</h5>
                        <p class="card-text">
                            <?php
                                $dsn = 'mysql:host=localhost;dbname=travel-app_db';
                                $username = 'root';
                                $password = 'root';

                                try {
                                    $pdo = new PDO($dsn, $username, $password);
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Esegui la query
                                    $sql = 'SELECT stage_name, stage_description FROM stages';
                                    $stmt = $pdo->query($sql);

                                    // Ciclare attraverso i risultati
                                    if ($stmt->rowCount() > 0) {
                                        echo '<table class="table table-striped">';
                                        echo '
                                            <thead>
                                                <tr>
                                                    <th>Nome Tappa</th>
                                                    <th>Descrizione Tappa</th>
                                                </tr>
                                            </thead>';
                                        echo '<tbody>';
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['stage_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['stage_description']) . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<p>Nessuna tappa presente in questo momento.</p>';
                                    }
                                } catch (PDOException $e) {
                                    echo '<p class="text-danger">Errore: ' . $e->getMessage() . '</p>';
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- right card -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Mappa</h5>
                        <div id="map" class="card-text"></div>
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

<script src="js/script.js" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js"></script>
<?php
    include __DIR__ . "/Views/footer.php"
?>