<?php
if(isset($_POST["register"])){
    $validation = true;
    $message = [];
    $passwordBuffer = "";

    foreach($_POST as $key => $value){
        // Ignorar el botón de envío
        if ($key === "register") {
            continue;
        }

        $value = trim($value);

        if ($value == "") {
            $message[] = '<p class="error-form"><b>' . $key . '</b> can not be null</p>';
            $validation = false;
        }

        if ($key == "password") {
            $passwordBuffer = $value;
        }

        if ($key == "password2") {
            if ($passwordBuffer != $value) {
                $message[] = '<p class="error-form">Passwords doesn\'t match</p>';
                $validation = false;
            }
        }
    }

    foreach ($message as $fruta) {
        echo $fruta . "<br>";
    }

    if($validation){
        $response = $controller->registerUser($_POST["username"],$_POST["password"],$_POST["name"],$_POST["email"]);
        //Si ya existe el alias o si ocurre un error al ejecutar la consulta vuelve a seccion registrar y muestra el mensaje.
        if(gettype($response) == "string"){
            $_SESSION["formdata"] = $_POST;
            $_SESSION["errorMessage"] = $response;
            echo $response;
        }else{
            $_SESSION["formdata"] = $_POST;
            header("Location:". $_SERVER['PHP_SELF']."?register=correct");
        }
        // si validación es false...
    }else{
        $_SESSION["formdata"] = $_POST; // almacena datos enviados por formulario
        $_SESSION["errorMessage"] = $message; //almacena mensaje de error.
    }// end if validacion. registrar
}// end if(isset($_POST["registrar"]))