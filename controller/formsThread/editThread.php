<?php
require_once '../controller/threadsController.php';

if (isset($_POST["editThread"])) {
    $message = [];
    $validation = true;

    foreach ($_POST as $key => $value) {
        $value = trim($value);
        if ($key === 'editThread') {
            continue; // saltar validación para el botón submit
        }
        if ($value === "") {
            $message[] = '<p class="error-form"> <b>' . htmlspecialchars($key) . '</b> can not be empty</p>';
            $validation = false;
        }
    }

    foreach ($message as $msg) {
        echo $msg . "<br>";
    }

    if ($validation) {
        $controller = new threadsController();
        $response = $controller->editThread((int)$_POST["threadID"], $_POST["name"], $_POST["message"]);

        if (is_string($response)) {
            $_SESSION["formdata"] = $_POST;
            $_SESSION["errorMessage"] = $response;
            echo $response;
        } else {
            $_SESSION["formdata"] = $_POST;
            header("Location: " . $_SERVER['PHP_SELF'] . "?threadRegister=correct&topicID=" . $_POST["topicID"]);
            exit();
        }
    } else {
        $_SESSION["formdata"] = $_POST;
        $_SESSION["errorMessage"] = $message;
    }
}

