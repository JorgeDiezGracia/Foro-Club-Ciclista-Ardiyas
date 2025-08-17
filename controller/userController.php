<?php
require_once '../model/user.php';

class userController {

    private userSession $userSession;

    /**
     * @param userSession $userSession
     */
    public function __construct()
    {
        $this->userSession = new userSession();
    }

    public function getUserName($userID){
        return user::getUserNameByID($userID);
    }

    public function registerUser($username, $password, $name, $email){
        return user::newUser($username, $password, $name, $email);
    }

    public function loginUser($usename, $password){
        return user::getUser($usename, $password);
    }
}


$controller = new userController();
if(isset($_POST["register"])){
    $validation = true;
    require_once ("formsUser/registerUser.php");
} else {
    if (isset($_POST["login"])) {
        $validation = true;
        require_once("formsUser/loginUser.php");
    }
}