<?php
require_once '../model/post.php';
require_once '../controller/userController.php';

class postController {
    private post $post;

    public function __construct() {
        $this->post = new post(0, "", 0, 0);
    }

    public function listPosts(int $threadID) {
        return $this->post->getPostsList($threadID);
    }

    public function registerPost(string $message, int $userID, int $threadID) {
        return $this->post->newPost($message, $userID, $threadID);
    }

    public function editPost(int $postID, string $message) {
        return $this->post->editPost($message, $postID);
    }

    public function deletePost(int $postID) {
        return $this->post->deletePost($postID);
    }
}

$controller = new postController();
$userController = new userController();

if (isset($_POST["registerPost"])) {
    $validation = true;
    require_once("formsPost/registerPost.php");
} elseif (isset($_POST["editPost"])) {
    $validation = true;
    require_once("formsPost/editPost.php");
} elseif (isset($_POST["deletePost"])) {
    require_once("formsPost/deletePost.php");
} elseif (isset($_GET["threadID"])) {
    $posts = $controller->listPosts((int)$_GET["threadID"]);
}
