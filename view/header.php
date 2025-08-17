<!DOCTYPE html>
<html lang="es">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FORO DE CICLISMO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        .navbar-brand,
        .nav-link {
            color: #40E0D0 !important; /* Turquesa */
        }

        .btn-turquesa {
            background-color: #000 !important; /* Negro */
            color: #40E0D0 !important;         /* Turquesa */
            border: 1px solid #40E0D0;
        }

        .btn-turquesa:hover {
            background-color: #40E0D0 !important;
            color: #000 !important;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/foroCCArdiyas/index.php">CLUB CICLISTA ARDIYAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/foroCCArdiyas/index.php">Foros</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if(isset($_SESSION["user"])) { ?>
                        <a href="/NewForum-PHP/index.php" class="btn btn-turquesa me-3">Mi usuario</a>
                        <form method="post" class="m-0">
                            <button type="submit" name="destroy" class="btn btn-turquesa">Logout</button>
                        </form>
                    <?php } else { ?>
                        <a href="/foroCCArdiyas/view/login.php" class="btn btn-outline-light me-2">Login</a>
                        <a href="/foroCCArdiyas/view/registerUser.php" class="btn btn-light">Registrarse</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_POST["destroy"])) {
        session_unset();
        session_destroy();
        header("Refresh:0");
    }
    ?>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

