<?php
include("header.php");
require_once ("../controller/threadsController.php");
?>

<style>
    body {
        background-color: #1c1c1c;
        color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
        color: #40E0D0;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .form-label {
        color: #f5f5f5;
        font-weight: 500;
    }

    .form-control {
        background-color: #1c1c1c;
        color: #ffffff;
        border: 1px solid #555;
        border-radius: 4px;
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
        padding: 0.75rem;
        border-radius: 4px;
        transition: background-color 0.2s ease;
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
        border-radius: 6px;
    }

    .alert-warning {
        background-color: #2a2a2a;
        border: 1px solid #ffcc00;
        color: #ffcc00;
        font-weight: 500;
        border-radius: 6px;
    }

    .container {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
</style>

<div class="container">
    <?php if (isset($_GET["threadRegister"]) && $_GET["threadRegister"] == "correct"): ?>
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
                    window.location.href = "listThreads.php?topicID=<?php echo htmlspecialchars($_GET["topicID"]); ?>";
                }
            }
            redireccionar();
        </script>

    <?php elseif (isset($_GET["topicID"])): ?>
    <?php if(isset($_SESSION["user"])): ?>
    <?php if(isset($_GET["edit"])): ?>
        <h2 class="text-center">✏️ Edit Thread</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">* Name:</label>
                        <input id="name" class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($_GET["name"]); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">* Message:</label>
                        <textarea id="message" class="form-control" name="message" rows="4" required><?php echo htmlspecialchars($_GET["message"]); ?></textarea>
                    </div>
                    <input type="hidden" name="topicID" value="<?php echo htmlspecialchars($_GET["topicID"]); ?>">
                    <input type="hidden" name="threadID" value="<?php echo htmlspecialchars($_GET["threadID"]); ?>">
                    <div class="d-grid">
                        <button type="submit" name="editThread" class="btn btn-success btn-lg">✅ Edit</button>
                    </div>
                </form>
            </div>
        </div>

    <?php else: ?>
        <h2 class="text-center">📝 Register Thread</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">* Name:</label>
                        <input id="name" class="form-control" type="text" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">* Message:</label>
                        <textarea id="message" class="form-control" name="message" rows="4" required></textarea>
                    </div>
                    <input type="hidden" name="topicID" value="<?php echo htmlspecialchars($_GET["topicID"]); ?>">
                    <input type="hidden" name="userID" value="<?php echo htmlspecialchars($_SESSION["userID"]); ?>">
                    <div class="d-grid">
                        <button type="submit" name="registerThread" class="btn btn-success btn-lg">✅ Register</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            ⚠️ <h4>You need to be logged in</h4>
        </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

