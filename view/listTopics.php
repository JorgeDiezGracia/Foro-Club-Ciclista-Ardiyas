<?php include("header.php"); ?>

<!-- Estilos minimalistas -->
<style>
    body {
        background-color: #1c1c1c; /* Gris oscuro tirando a negro */
        color: #f5f5f5;           /* Blanco suave */
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
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

    .btn-outline-secondary {
        color: #f5f5f5;
        border-color: #888;
        background-color: transparent;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #f5f5f5;
        color: #1c1c1c;
    }

    .alert-warning {
        background-color: #2a2a2a;
        border: 1px solid #555;
        color: #ffcc00;
        font-weight: 500;
    }
    .card-img-top {
        max-height: 200px;
        width: 100%;
        object-fit: contain;
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 6px;
    }
</style>

<div class="container-sm text-center mt-5">
    <h2 class="mb-3">FORO DE CICLISMO</h2>
</div>

<div class="album py-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (!empty($topics) && is_array($topics)): ?>
                <?php foreach ($topics as $topic): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-text"><?php echo htmlspecialchars($topic['name']); ?></p>
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="view/listThreads.php?topicID=<?php echo urlencode($topic['topicID']); ?>" class="btn btn-sm btn-outline-secondary">
                                        👁️ Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        ⚠️ No hay temas disponibles.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>

