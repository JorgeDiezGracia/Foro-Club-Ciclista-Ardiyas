<?php
include("header.php");
require_once("../controller/userController.php");
?>

<style>
    body {
        background-color: #1c1c1c;
        color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
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

    .alert-success {
        background-color: #28a745;
        border: none;
        color: #fff;
        font-weight: 500;
    }

    h2 {
        color: #40E0D0;
    }
</style>

<div class="container py-5">
    <?php if (isset($_GET["register"]) && $_GET["register"] == "correct"): ?>
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading">✅ Registro correcto</h4>
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

    <?php else: ?>
        <h2 class="text-center mb-4">📝 Usuario registrado</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">* Username:</label>
                        <input id="username" class="form-control" type="text" name="username" value="<?php echo isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">* Name:</label>
                        <input id="name" class="form-control" type="text" name="name" value="<?php echo isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">* Password:</label>
                        <input id="password" class="form-control" type="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password2" class="form-label">* Repite password:</label>
                        <input id="password2" class="form-control" type="password" name="password2" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">* Email:</label>
                        <input id="email" class="form-control" type="email" name="email" value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : ''; ?>" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="register" class="btn btn-success btn-lg">✅ Register</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
