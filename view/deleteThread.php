<?php
include("header.php");
include_once '../controller/threadsController.php';
?>

<style>
    body {
        background-color: #1c1c1c;
        color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }

    h1 {
        color: #40E0D0;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    p {
        font-size: 1.1rem;
        color: #dddddd;
    }

    .btn-danger {
        background-color: #ff4d4d;
        border: none;
        color: #1c1c1c;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }

    .btn-danger:hover {
        background-color: #ff6666;
        color: #000;
    }

    .btn-secondary {
        background-color: #444;
        border: none;
        color: #f5f5f5;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .btn-secondary:hover {
        background-color: #666;
        color: #fff;
    }

    .btn-primary {
        background-color: #40E0D0;
        border: none;
        color: #1c1c1c;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }

    .btn-primary:hover {
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

<?php
if (isset($_SESSION["user"])) {
    if (isset($_GET["threadDelete"]) && $_GET["threadDelete"] == "correct") {
        ?>
        <div class="container text-center">
            <div class="alert alert-success" role="alert">
                ✅ Thread deleted successfully.
            </div>
            <p>Redirecting in <span id="contador">5</span> seconds...</p>
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
                    window.location.href = "listThreads.php?topicID=<?php echo urlencode($_GET["topicID"]); ?>";
                }
            }
            redireccionar();
        </script>
        <?php
    } else {
        ?>
        <div class="container">
            <h1>🗑 Delete Confirmation</h1>
            <p>Are you sure you want to delete this thread?</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input type="hidden" name="topicID" value="<?php echo htmlspecialchars($_GET["topicID"]); ?>">
                <input type="hidden" name="threadID" value="<?php echo htmlspecialchars($_GET["threadID"]); ?>">
                <button type="submit" name="deleteThread" class="btn btn-danger me-2">Confirm</button>
                <a href="listThreads.php?topicID=<?php echo urlencode($_GET["topicID"]); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <?php
    }
} else {
    ?>
    <div class="container text-center">
        <div class="alert alert-warning" role="alert">
            ⚠️ You need to be logged in to perform this action.
        </div>
        <a href="login.php" class="btn btn-primary">Login</a>
    </div>
    <?php
}
?>
</body>
</html>

