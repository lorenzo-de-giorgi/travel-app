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
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Scrivi qui il messaggio"    id="messaggio" name="messaggio" style="height: 100px"></textarea>
                                    <label for="messaggio">Messaggio</label>
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
                                    $sql = 'SELECT nome, email, content FROM test';
                                    $stmt = $pdo->query($sql);

                                    // Ciclare attraverso i risultati
                                    if ($stmt->rowCount() > 0) {
                                        echo '<table class="table table-striped">';
                                        echo '
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Messaggio</th>
                                                </tr>
                                            </thead>';
                                        echo '<tbody>';
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['content']) . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<p>Nessun risultato trovato.</p>';
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