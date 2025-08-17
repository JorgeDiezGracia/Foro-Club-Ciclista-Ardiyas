<?php
include("header.php");
require_once("../controller/userController.php");
?>

<style>
    body {
        background-color: #1c1c1c; /* Gris oscuro tirando a negro */
        color: #f5f5f5;           /* Blanco suave */
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 8px;
        color: #ffffff;
        box-shadow: none;
    }

    .form-label {
        color: #f5f5f5;
    }

    .form-control {
        background-color: #1c1c1c;
        color: #ffffff;
        border: 1px solid #555;
    }

    .form-control:focus {
        background-color: #1c1c1c;
        color: #ffffff;
        border-color: #40E0D0;
        box-shadow: none;
    }

    .btn-success {
        background-color: #40E0D0;
        border: none;
        color: #1c1c1c;
        font-weight: 600;
    }

    .btn-success:hover {
        background-color: #2dd2c3;
        color: #000;
    }

    .alert-danger {
        background-color: #ff4d4d;
        border: none;
        color: #fff;
        font-weight: 500;
    }

    a {
        color: #40E0D0;
        text-decoration: none;
    }

    a:hover {
        color: #2dd2c3;
        text-decoration: underline;
    }
</style>

<?php if (isset($_GET["login"]) && $_GET["login"] === "correct"): ?>
    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="text-center">
            <h2 class="mb-3">✅ Login correcto</h2>
            <p>Redirigiendo en <span id="contador">5</span> segundos...</p>
        </div>

        <script>
            function redireccionar() {
                const contadorElemento = document.getElementById("contador");
                let segundos = parseInt(contadorElemento.textContent);

                if (segundos > 0) {
                    segundos--;
                    contadorElemento.textContent = segundos;
                    setTimeout(redireccionar, 1000);
                } else {
                    window.location.href = "../index.php";
                }
            }
            redireccionar();
        </script>
    </div>
<?php else: ?>
    <body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="min-width: 320px; max-width: 400px; width: 100%;">
            <h1 class="text-center mb-4">Login</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
                <?php if (isset($_GET["errorLogin"])): ?>
                    <div class="alert alert-danger" role="alert">
                        ❌ Usuario o contraseña incorrectos.
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            required
                            value="<?php echo isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : ''; ?>"
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                    >
                </div>

                <button type="submit" name="login" class="btn btn-success w-100">🔐 Login</button>
            </form>
            <div class="mt-3 text-center">
                <a href="registerUser.php">📝 New user register</a>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php endif; ?>
