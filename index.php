<?php
// Conexión a la base de datos
require_once 'model/BDConnection/BDConnection.php';

// Definimos carpeta de controladores con ruta absoluta
define('CONTROLLERS_FOLDER', __DIR__ . '/controller/');

// Controlador y acción por defecto
const DEFAULT_CONTROLLER = 'topic';
const DEFAULT_ACTION = 'listTopics';

// Obtenemos el controlador solicitado o el por defecto
$controller = DEFAULT_CONTROLLER;
if (!empty($_GET['controller'])) {
    $controller = $_GET['controller'];
}

// Formamos nombre de la clase del controlador
$controllerClass = $controller . 'controller';

// Ruta completa al archivo del controlador
$controllerFile = CONTROLLERS_FOLDER . $controller . 'controller.php';

// Comprobamos si el archivo existe y lo requerimos
if (is_file($controllerFile)) {
    require_once($controllerFile);
} else {
    die('Controller not found - 404 not found');
}

// Obtenemos la acción solicitada o la por defecto
$action = DEFAULT_ACTION;
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Creamos instancia del controlador
$controllerObject = new $controllerClass();

// Formamos la función a llamar
$methodVariable = array($controllerObject, $action);

// Ejecutamos la acción si existe
if (is_callable($methodVariable)) {
    $methodVariable();
} else {
    die('Action not found - 404 not found');
}
