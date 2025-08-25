<?php
require_once 'model/topic.php';

class topicController {
    private Topic $topic;

    public function __construct()
    {
        $this->topic = new Topic(0, "");
    }

    public function listTopics(){
        $topics = $this->topic->getTopicsList();

        // Validar que $topics sea un array para evitar errores en la vista
        if (!is_array($topics)) {
            // Manejar error (puedes mostrar mensaje o redirigir)
            die("Error: No se pudo obtener la lista de topics.");
        }

        include 'view/listTopics.php';
    }
}