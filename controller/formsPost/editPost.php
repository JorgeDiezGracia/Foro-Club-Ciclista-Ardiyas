<?php
if (isset($_POST["editPost"])) {
    $message = [];
    $validation = true;

    // Solo validar el campo 'message'
    $messageContent = trim($_POST["message"] ?? "");
    if ($messageContent === "") {
        $message[] = '<p class="error-form"><b>Message</b> Este campo no puede estar vacío</p>';
        $validation = false;
    }

    // Mostrar errores
    foreach ($message as $errorMsg) {
        echo $errorMsg . "<br>";
    }

    if ($validation) {
        // Llamar al controller con el orden correcto: postID primero, message después
        $response = $controller->editPost($_POST["postID"], $messageContent);

        if (is_string($response)) {
            $_SESSION["formdata"] = $_POST;
            $_SESSION["errorMessage"] = $response;
            echo $response;
        } else {
            $_SESSION["formdata"] = $_POST;
            header("Location: " . $_SERVER['PHP_SELF'] . "?postEdit=correct&threadID=" . $_POST["threadID"]);
            exit;
        }
    } else {
        $_SESSION["formdata"] = $_POST;
        $_SESSION["errorMessage"] = $message;
    }
}

