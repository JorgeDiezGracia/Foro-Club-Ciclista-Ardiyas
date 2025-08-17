<?php
include("header.php");
include_once '../controller/threadsController.php';
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h3>List of Threads</h3>
    </div>

    <div class="album py-4 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php if ($threads != null): ?>
                    <?php foreach ($threads as $tem): ?>
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate"><?php echo htmlspecialchars($tem['name']); ?></h5>
                                    <p class="card-text text-truncate"><?php echo isset($tem['message']) ? htmlspecialchars($tem['message']) : ''; ?></p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="viewPost.php?threadID=<?php echo urlencode($tem['threadID']); ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                            <?php if (isset($_SESSION["user"], $_SESSION["role"])): ?>
                                                <?php
                                                $isAdmin = $_SESSION["role"] === "admin";
                                                $isOwner = $_SESSION["role"] === "user" && $_SESSION["userID"] === $tem["userID"];
                                                ?>
                                                <?php if ($isAdmin || $isOwner): ?>
                                                    <a href="deleteThread.php?topicID=<?php echo urlencode($tem["topicID"] ?? ''); ?>&threadID=<?php echo urlencode($tem["threadID"]); ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                                    <a href="registerThread.php?topicID=<?php echo urlencode($tem["topicID"] ?? ''); ?>&edit=true&message=<?php echo urlencode($tem["message"] ?? ''); ?>&threadID=<?php echo urlencode($tem["threadID"]); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            No threads available.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

