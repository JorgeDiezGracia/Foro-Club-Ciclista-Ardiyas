<?php
require_once '../model/BDConnection/BDConnection.php';
class thread {
    private int $threadID;
    private string $name;
    private string $message;
    private int $userID;
    private int $topicID;

    /**
     * @param int $threadID
     * @param string $name
     * @param string $message
     * @param int $userID
     * @param int $topicID
     */
    public function __construct(int $threadID, string $name, string $message, int $userID, int $topicID)
    {
        $this->threadID = $threadID;
        $this->name = $name;
        $this->message = $message;
        $this->userID = $userID;
        $this->topicID = $topicID;
    }


    /**
     * @return int
     */
    public function getThreadID(): int
    {
        return $this->threadID;
    }

    /**
     * @param int $threadID
     */
    public function setThreadID(int $threadID): void
    {
        $this->threadID = $threadID;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return int
     */
    public function getTopicID(): int
    {
        return $this->topicID;
    }

    /**
     * @param int $topicID
     */
    public function setTopicID(int $topicID): void
    {
        $this->topicID = $topicID;
    }

    function getThreadsList($topicID) {
        try {
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }

            $sql = "SELECT * FROM threads WHERE topicID = :topicID";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":topicID" => $topicID));
            $response = $response->fetchAll(PDO::FETCH_ASSOC);

            $connection = null;

            if($response) {
                return $response;
            } else {
                $response = null;
            }
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    public function getThread($threadID)
    {
        try {
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }

            $sql = "SELECT * FROM threads WHERE threadID = :threadID";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":threadID" => $threadID));
            $response = $response->fetch(PDO::FETCH_ASSOC);

            $connection = null;

            if($response) {
                $threa = new thread($response["threadID"], $response["name"], $response["message"], $response["userID"], $response["topicID"]);
                return $threa;
            } else {
                return $threa = null;
            }
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    function newThread($name, $message, $userID, $topicID) {
        try {
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }
            $sql = "INSERT INTO threads (name, message, userID, topicID) VALUES (:name,:message,:userID,:topicID)";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":name"=> $name,":message" => $message, ":userID" => $userID, ":topicID" => $topicID));

            $connection = null;
            return  $response;
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    function editThread($threadID, $name, $message) {
        try {
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }
            $sql = "UPDATE threads SET name = :name , message = :message WHERE threadId = :threadID";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":name"=> $name, ":message" => $message, ":threadID" => $threadID));

            $connection = null;
            return  $response;
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    function deleteThread($threadID) {
        try {
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }
            $sql = "DELETE FROM threads WHERE threadId = :threadID";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":threadID" => $threadID));

            $connection = null;
            return  $response;
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }


}