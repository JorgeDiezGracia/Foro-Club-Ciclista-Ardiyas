<?php
require_once("../controller/postController.php");
require_once("../model/userSession.php");

$session = new userSession();
$userID = $session->getSession("userID");

if (!$userID) {
    echo '<p class="error-form">⚠️ You must be logged in to post</p>';
    return;
}

$message = trim($_POST["message"] ?? "");
$threadID = (int)($_POST["threadID"] ?? 0);

if ($message === "") {
    echo '<p class="error-form">⚠️ Message cannot be empty</p>';
    return;
}

if ($threadID <= 0) {
    echo '<p class="error-form">⚠️ Invalid thread ID</p>';
    return;
}

$controller = new postController();
$success = $controller->registerPost($message, $userID, $threadID);

if ($success) {
    echo '<p class="success-form">✅ Post created successfully</p>';
    // Puedes redirigir si quieres:
    // header("Location: ../view/thread.php?threadID=" . $threadID);
    // exit();
} else {
    echo '<p class="error-form">❌ Failed to create post</p>';
}
?>

