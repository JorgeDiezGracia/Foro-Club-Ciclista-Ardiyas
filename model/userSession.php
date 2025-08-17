<?php

class userSession {

    function __construct() {
        //session_start();
    }

    public static function newSession($key,$value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getSession($key) {
        return $_SESSION[$key] ?? false;
    }

    public function deleteSession(): void
    {
        $_SESSION = array();
        session_destroy();
    }

}