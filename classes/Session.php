<?php

class Session {
    public static function start() {
        session_start();
    }

    public static function destroy() {
        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['username']);
    }
}
?>