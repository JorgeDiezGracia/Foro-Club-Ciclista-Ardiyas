<?php
if (isset($_POST["registerThread"])) {
    $requiredFields = ["name", "message", "userID", "topicID"];
    $errors = [];
    $validation = true;

    // Validar sólo los campos requeridos
    foreach ($requiredFields as $field) {
        $value = trim($_POST[$field] ?? "");
        if ($value === "") {
            $errors[] = "<p class='error-form'><b>$field</b> cannot be empty</p>";
            $validation = false;
        }
    }

    // Mostrar mensajes de error si existen
    if (!$validation) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        $_SESSION["formdata"] = $_POST;
        $_SESSION["errorMessage"] = $errors;
        return; // salir para no continuar con el registro
    }

    // Si la validación es correcta, proceder a registrar
    $response = $controller->registerThread(
        $_POST["name"],
        $_POST["message"],
        $_POST["userID"],
        $_POST["topicID"]
    );

    if (is_string($response)) {
        // Aquí recibimos un error como string desde el controlador
        $_SESSION["formdata"] = $_POST;
        $_SESSION["errorMessage"] = [$response];
        echo $response;
    } else {
        // Registro correcto, redirigir
        $_SESSION["formdata"] = $_POST;
        header("Location: " . $_SERVER['PHP_SELF'] . "?threadRegister=correct&topicID=" . urlencode($_POST["topicID"]));
        exit();
    }
}
?>
