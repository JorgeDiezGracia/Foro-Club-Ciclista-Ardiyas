<?php
if(isset($_POST["deleteThread"])){
    $response = $controller->deleteThread($_POST["threadID"]);
    if(gettype($response) == "string"){
        $_SESSION["formdata"] = $_POST;
        $_SESSION["errorMessage"] = $response;
        echo $response;
    }else{
        $_SESSION["formdata"] = $_POST;

        //PUEDE NO ESTAR BIEN
        header("Location:". $_SERVER['PHP_SELF']."?threadDelete=correct&topicID=".$_POST["topicID"]);
    }
}
