<?php
require_once("../controller/postController.php");
require_once("../model/userSession.php");

$session = new userSession();
$userID = $session->getSession("userID");

if (!$userID) {
    echo '<p class="error-form">⚠️ Debes de estar logueado</p>';
    return;
}

$message = trim($_POST["message"] ?? "");
$threadID = (int)($_POST["threadID"] ?? 0);

if ($message === "") {
    echo '<p class="error-form">⚠️ El mensaje no puede estar vacío</p>';
    return;
}

if ($threadID <= 0) {
    echo '<p class="error-form">⚠️ ID de tema inválido</p>';
    return;
}

$controller = new postController();
$success = $controller->registerPost($message, $userID, $threadID);

if ($success) {
    echo '<p class="success-form">✅ Comentario creado satisfactoriamente</p>';
    // Puedes redirigir si quieres:
    // header("Location: ../view/thread.php?threadID=" . $threadID);
    // exit();
} else {
    echo '<p class="error-form">❌ Error al crear el comentario</p>';
}
?>

