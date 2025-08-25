<?php
require_once 'model/BDConnection/BDConnection.php';

class topic {
    private int $topicID;
    private string $name;

    public function __construct($topicID, $name) {
        $this->topicID = $topicID;
        $this->name = $name;
    }

    public function getTopicsList() {
        try {
            $connection = BDConnection::ConnectBD();

            if (!($connection instanceof PDO)) {
                // Si la conexión falla, mostrar error y detener ejecución
                die("Error de conexión a la base de datos: " . $connection);
            }

            $sql = "SELECT * FROM topics";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $connection = null;
            return $result ?: [];
        } catch (PDOException $e) {
            die("Excepción en la base de datos: " . $e->getMessage());
        }
    }

}