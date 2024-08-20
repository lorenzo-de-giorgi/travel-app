<?php
    include __DIR__ . "/Views/header.php";

    session_start();

    // Controlla se l'utente è loggato
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

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

    // recuper l'id del viaggio
    $travel_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    // Recupera le informazioni del viaggio dal database
    $stmt = $conn->prepare("SELECT id, user_id, name, description FROM travels WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $travel_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $travel = $result->fetch_assoc();

    if (!$travel) {
        echo "Viaggio non trovato o non autorizzato.";
        exit();
    }

    $stmt->close();
    $conn->close();
?>

<header>
    <div class="mt-nav">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <img src="./img/logo.png" alt="logo" id="mt-logo">
                <ul class="list-unstyled">
                    <!-- <li class="mt-3"><a class="mt-delete" href="">Cancella Viaggio</a></li> -->
                </ul>
            </nav>
        </div>
    </div>
</header>

<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Crea Nuova Tappa</h5>
                        <p class="card-text">
                            <form action="./www/create_stage.php" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome Tappa</label>
                                    <input placeholder="Inserisci il nome della tappa da creare" type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Indirizzo Tapppa</label>
                                    <input placeholder="Inserisci l'indirizzo della tappa da creare" type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descrizione Tappa</label>
                                    <input placeholder="Inserisci la descrizione della tappa da creare" type="text" class="form-control" id="description" name="description" required>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" id="travel_id" name="travel_id" value="<?php echo $travel_id; ?>" required>
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
                                $sql = 'SELECT id, stage_name, stage_address, stage_description, stage_completed FROM stages';
                                $stmt = $pdo->query($sql);

                                // Ciclare attraverso i risultati
                                if ($stmt->rowCount() > 0) {
                                    echo '<table class="table table-striped">';
                                    echo '
                                        <thead>
                                            <tr>
                                                <th>Nome Tappa</th>
                                                <th>Indirizzo Tappa</th>
                                                <th>Descrizione Tappa</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>';
                                    echo '<tbody>';
                                    while ($travel = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $isCompleted = $travel['stage_completed'] == 1;
                                        $strikeThrough = $isCompleted ? 'style="text-decoration: line-through;"' : '';
                                        echo '<tr>';
                                        echo '<td ' . $strikeThrough . '>' . htmlspecialchars($travel['stage_name']) . '</td>';
                                        echo '<td ' . $strikeThrough . '>' . htmlspecialchars($travel['stage_address']) . '</td>';
                                        echo '<td ' . $strikeThrough . '>' . htmlspecialchars($travel['stage_description']) . '</td>';
                                        echo '<td class="d-flex">';
                                        // stage_completed update
                                        echo '<form method="post" action="./www/update_stage.php">';
                                        echo '<input type="hidden" name="id" value="' . htmlspecialchars($travel['id']) . '">';
                                        echo '<button type="submit" class="mt-a btn">' . ($isCompleted ? '<i class="fa-solid fa-times"></i>' : '<i class="fa-solid fa-check"></i>') . '</button>';
                                        echo '</form>';
                                        // stage_delete
                                        echo '<form method="post" action="./www/delete_stage.php">';
                                        echo '<input type="hidden" name="id" value="' . htmlspecialchars($travel['id']) . '">';
                                        echo '<button type="submit" class="mt-a btn"><i class="fa-solid fa-trash-can"></i></button>';
                                        echo '</form>';
                                        echo '</tr>';
                                        echo '</td>';
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

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Mappa</h5>
                        <div id="map" class="card-text"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
include __DIR__ . "/Views/footer.php";
?>
