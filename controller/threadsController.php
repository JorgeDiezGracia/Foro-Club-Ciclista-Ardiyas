<?php
require_once '../model/thread.php';
require_once '../controller/userController.php';
class threadsController {
    private Thread $thread;

    public function __construct(){
        $this->thread = new thread(0, "","",0,0);
    }

    public function listThreads($topicID){
        return $this->thread->getThreadsList($topicID);
    }

    public function getThread($threadID){
        return $this->thread->getThread($threadID);
    }

    public function registerThread($name, $message, $userID, $topicID){
        return $this->thread->newThread($name, $message, $userID, $topicID);
    }

    public function editThread($threadID, $name, $message){
        return $this->thread->editThread($threadID, $name, $message);
    }

    public function deleteThread($threadID) {
        return $this->thread->deleteThread($threadID);
    }
}

$controller = new threadsController();
$userController = new userController();
if (isset($_POST["registerThread"])){
    $validation = true;
    require_once ("formsThread/registerThread.php");
} else {
    if (isset($_POST["editThread"])){
        $validation = true;
        require_once ("formsThread/editThread.php");
    } else {
        if (isset($_POST["deleteThread"])){
            $validation = true;
            require_once ("formsThread/deleteThread.php");
        } else {                                                          // Puede dar problemas
            if(isset($_GET["topicID"])){
                $threads = $controller->listThreads($_GET["topicID"]);
            } else {
                if(isset($_GET["threadID"])){
                    $thread = $controller->getThread($_GET["threadID"]);
                }
            }
        }
    }
}