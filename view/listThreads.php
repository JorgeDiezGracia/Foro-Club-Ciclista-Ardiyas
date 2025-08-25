<?php
include("header.php");
include_once '../controller/threadsController.php';
?>

<!-- Estilos minimalistas -->
<style>
    body {
        background-color: #1c1c1c; /* Gris oscuro tirando a negro */
        color: #f5f5f5;           /* Blanco suave */
        font-family: 'Segoe UI', sans-serif;
    }

    h3 {
        color: #ffffff;
        font-weight: 600;
    }

    .album {
        background-color: #1c1c1c;
    }

    .card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 8px;
        color: #ffffff;
        transition: box-shadow 0.2s ease;
    }

    .card:hover {
        box-shadow: 0 2px 8px rgba(255, 255, 255, 0.05);
    }

    .card-body {
        padding: 1rem;
    }

    .card-text {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .btn-group a {
        margin-right: 0.3rem;
    }

    /* Botón Ver */
    .btn-outline-secondary {
        color: #f5f5f5;
        border-color: #888;
        background-color: transparent;
    }

    .btn-outline-secondary:hover {
        background-color: #f5f5f5;
        color: #1c1c1c;
    }

    /* Botón Eliminar en rojo con ícono */
    .btn-outline-danger {
        color: #ff4d4d;
        border-color: #ff4d4d;
        background-color: transparent;
    }

    .btn-outline-danger:hover {
        background-color: #ff4d4d;
        color: #fff;
    }

    /* Botón Editar en azul con ícono */
    .btn-outline-primary {
        color: #4da6ff;
        border-color: #4da6ff;
        background-color: transparent;
    }

    .btn-outline-primary:hover {
        background-color: #4da6ff;
        color: #fff;
    }

    /* Botón Nuevo Tema */
    .btn-nuevo-tema {
        color: #4da6ff;
        border: 1px solid #4da6ff;
        background-color: transparent;
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
        border-radius: 4px;
    }

    .btn-nuevo-tema:hover {
        background-color: #4da6ff;
        color: #fff;
    }
</style>

<div class="container-sm text-center w-25 mt-5">
    <h3 class="mb-3">Temas</h3>
</div>

<?php if (isset($_SESSION["user"])): ?>
    <div class="container-sm mb-4 text-center">
        <a href="registerThread.php?topicID=<?php echo urlencode($_GET["topicID"]); ?>" class="btn btn-nuevo-tema">
            ✏️ Nuevo Tema
        </a>
    </div>
<?php endif; ?>

<div class="album py-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (!empty($threads)): ?>
                <?php foreach ($threads as $tem): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-text"><?php echo htmlspecialchars($tem['name']); ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="btn-group">
                                        <a href="viewPost.php?threadID=<?php echo urlencode($tem['threadID']); ?>" class="btn btn-sm btn-outline-secondary">
                                            👁️ Ver
                                        </a>
                                        <?php if (isset($_SESSION["user"], $_SESSION["role"])): ?>
                                            <?php
                                            $canEditDelete = false;
                                            if ($_SESSION["role"] === "admin") {
                                                $canEditDelete = true;
                                            } elseif ($_SESSION["role"] === "user" && $_SESSION["userID"] == $tem["userID"]) {
                                                $canEditDelete = true;
                                            }
                                            ?>
                                            <?php if ($canEditDelete): ?>
                                                <a href="deleteThread.php?topicID=<?php echo urlencode($tem['topicID']); ?>&threadID=<?php echo urlencode($tem["threadID"]); ?>" class="btn btn-sm btn-outline-danger">
                                                    🗑️ Eliminar
                                                </a>
                                                <a href="registerThread.php?topicID=<?php echo urlencode($tem['topicID']); ?>&edit=true&name=<?php echo urlencode($tem["name"]); ?>&message=<?php echo urlencode($tem["message"]); ?>&threadID=<?php echo urlencode($tem["threadID"]); ?>" class="btn btn-sm btn-outline-primary">
                                                    ✏️ Editar
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">SIN TEMAS</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>

