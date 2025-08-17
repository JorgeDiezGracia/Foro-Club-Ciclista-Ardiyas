<?php
if (isset($_POST["login"])){
    foreach ($_POST as $key => $value) {
        $value = trim($value);
    }
    $user = $controller->loginUser($_POST["username"], $_POST["password"]);
    $_SESSION["userData"] = $user;
    if (gettype($user) == "string") {
        $_SESSION["formdata"] = $_POST;
        $_SESSION["loginMessage"] = $user;
        header("Location:" . $_SERVER['PHP_SELF'] . "?errorLogin");
    } else {
        if ($user == null) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?errorLogin");
        } else {
            //require_once("email.php"); // requiere el archivo email.
            //$_SESSION["mensajeregistrar"] = Email::email_registrar($_SESSION["formdata"]); // llama a la función email y y almacena el mensaje que devuelve.
            header("Location:" . $_SERVER['PHP_SELF']. "?login=correct");
        }
    }
}