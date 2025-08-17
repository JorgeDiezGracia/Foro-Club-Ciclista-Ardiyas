<?php
if (isset($_POST["deletePost"])) {
    $response = $controller->deletePost($_POST["postID"]);

    if (is_string($response)) {
        $_SESSION["formdata"] = $_POST;
        $_SESSION["errorMessage"] = $response;
        echo $response;
    } else {
        $_SESSION["formdata"] = $_POST;
        header("Location: " . $_SERVER['PHP_SELF'] . "?postDelete=correct&threadID=" . $_POST["threadID"]);
        exit;
    }
}

