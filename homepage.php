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

<header>
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
</header>

<main>
    
</main>

<?php
    include __DIR__ . "./Views/footer.php";
?>