<?php

require_once __DIR__ . '/config.php';
class BDConnection {

    public static function ConnectBD() {
        try {
            $conexion = new PDO(
                "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8",
                USER,
                PASS
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            return self::mensajes($e->getCode());
        }
    }

    public static function mensajes(string $e): string {
        switch ($e) {
            case "2002":
                return "<p class='error-form'>Error al conectar!! El host es incorrecto: ($e)</p>";
            case "1049":
                return "<p class='error-form'>Error al conectar!! No se encuentra la Base de datos: ($e)</p>";
            case "1045":
                return "<p class='error-form'>Error al conectar!! Usuario y/o Contraseña incorrecta: ($e)</p>";
            case "42S02":
                return "<p class='error-form'>Error en la consulta!! No se encuentra la Tabla: ($e)</p>";
            case "23000":
                return "<p class='error-form'>Ya existe el usuario. Prueba con otro alias ($e)</p>";
            default:
                return "<p class='error-form'>Error al conectar!! ERROR INESPERADO $e</p>";
        }
    }

}