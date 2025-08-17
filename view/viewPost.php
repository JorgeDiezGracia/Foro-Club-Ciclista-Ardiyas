<?php
include("header.php");
include_once '../controller/postController.php';
include_once '../controller/threadsController.php';
?>

<style>
    body {
        background-color: #1c1c1c;
        color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
        color: #40E0D0;
        border-bottom: 1px solid #444;
        padding-bottom: 0.5rem;
    }

    .bg-primary {
        background-color: #2a2a2a !important;
        color: #f5f5f5 !important;
    }

    .card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 8px;
        color: #ffffff;
        box-shadow: none;
    }

    .card-subtitle {
        color: #bbbbbb;
        font-weight: 500;
    }

    .card-footer {
        border-top: 1px solid #555;
    }

    .btn-outline-danger {
        color: #ff4d4d;
        border-color: #ff4d4d;
    }

    .btn-outline-danger:hover {
        background-color: #ff4d4d;
        color: #1c1c1c;
    }

    .btn-outline-primary {
        color: #40E0D0;
        border-color: #40E0D0;
    }

    .btn-outline-primary:hover {
        background-color: #40E0D0;
        color: #1c1c1c;
    }

    .btn-primary {
        background-color: #40E0D0;
        border: none;
        color: #1c1c1c;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #2dd2c3;
        color: #000;
    }

    .alert-info {
        background-color: #2a2a2a;
        border: 1px solid #40E0D0;
        color: #40E0D0;
    }

    .alert-warning {
        background-color: #2a2a2a;
        border: 1px solid #ffcc00;
        color: #ffcc00;
    }

    .bi {
        color: #40E0D0;
    }
</style>

<div class="container py-5">
    <?php if ($thread != null): ?>
        <h2 class="mb-4"><?php echo htmlspecialchars($thread->getName()); ?></h2>

        <div class="mb-5">
            <div class="p-4 bg-primary rounded">
                <h5 class="mb-3"><i class="bi bi-chat-left-text-fill me-2"></i> Mensaje principal</h5>
                <p class="mb-0"><?php echo nl2br(htmlspecialchars($thread->getMessage())); ?></p>
            </div>
        </div>

        <div class="row g-4">
            <?php if ($posts != null && count($posts) > 0): ?>
                <?php foreach ($posts as $tem): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2">
                                    <i class="bi bi-person-circle me-1"></i>
                                    USER: <?php echo htmlspecialchars($tem->getUserName()); ?>
                                </h6>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($tem->getMessage())); ?></p>
                            </div>
                            <?php if (isset($_SESSION["user"])): ?>
                                <div class="card-footer d-flex justify-content-between">
                                    <?php if (isset($_SESSION["role"])): ?>
                                        <?php if ($_SESSION["role"] == "admin" || ($_SESSION["role"] == "user" && $_SESSION["userID"] == $tem->getUserID())): ?>
                                            <a href="deletePost.php?threadID=<?php echo $thread->getThreadID(); ?>&postID=<?php echo $tem->getID(); ?>" class="btn btn-sm btn-outline-danger">🗑 Delete</a>
                                            <a href="registerPost.php?threadID=<?php echo $thread->getThreadID(); ?>&edit=true&message=<?php echo urlencode($tem->getMessage()); ?>&postID=<?php echo $tem->getID(); ?>" class="btn btn-sm btn-outline-primary">✏️ Edit</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        💬 Este tema no tiene comentarios.
                    </div>
                </div>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            ⚠️ The thread does not exist.
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["user"]) && $thread != null): ?>
        <div class="mt-4 text-end">
            <a href="registerPost.php?threadID=<?php echo $thread->getThreadID(); ?>" class="btn btn-primary">➕ New Post</a>
        </div>
    <?php endif; ?>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</body>
</html>

