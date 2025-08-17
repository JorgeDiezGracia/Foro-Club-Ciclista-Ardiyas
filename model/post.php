<?php
require_once __DIR__ . '/BDConnection/BDConnection.php';
require_once __DIR__ . '/user.php';

class post {
    private int $postId;
    private string $message;
    private int $userID;
    private int $threadID;

    public function __construct($postId, $message, $userID, $threadID) {
        $this->postId = $postId;
        $this->message = $message;
        $this->userID = $userID;
        $this->threadID = $threadID;
    }

    // Registrar nuevo post
    public function newPost($message, $userID, $threadID) {
        $db = BDConnection::ConnectBD();
        $stmt = $db->prepare("INSERT INTO posts (message, userID, threadID) VALUES (?, ?, ?)");
        return $stmt->execute([$message, $userID, $threadID]);
    }

    // Editar post
    public function editPost($message, $postID) {
        $db = BDConnection::ConnectBD();
        $stmt = $db->prepare("UPDATE posts SET message = ? WHERE postId = ?");
        return $stmt->execute([$message, $postID]);
    }

    // Borrar post
    public function deletePost($postID) {
        $db = BDConnection::ConnectBD();
        $stmt = $db->prepare("DELETE FROM posts WHERE postId = ?");
        return $stmt->execute([$postID]);
    }

    // Listar posts de un thread
    public function getPostsList($threadID) {
        $db = BDConnection::ConnectBD();
        $stmt = $db->prepare("SELECT * FROM posts WHERE threadID = ? ORDER BY postId ASC");
        $stmt->execute([$threadID]);
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new post($row['postId'], $row['message'], $row['userID'], $row['threadID']);
        }
        return $posts;
    }

    // Getters
    public function getID() { return $this->postId; }
    public function getMessage() { return $this->message; }
    public function getUserID() { return $this->userID; }
    public function getThreadID() { return $this->threadID; }

    // Obtener nombre del usuario que hizo el post
    public function getUserName() {
        $userData = user::getUserNameByID($this->userID);
        return $userData["username"];
    }
}
?>
