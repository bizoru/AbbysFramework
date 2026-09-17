<?php

class SessionMan {

    private static function ensureSessionStarted() {

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    static function getSessionValue($key) {


        self::ensureSessionStarted();
        $result = isset($_SESSION[$key]) ? $_SESSION[$key] : null;

        return $result;
    }

    static function deleteSessionValue($key) {

        self::ensureSessionStarted();

        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    static function setSessionValue($value, $key) {

        self::ensureSessionStarted();
        $_SESSION[$key] = $value;
    }

    static function initSession() {

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_name(md5('WebID'));
            session_start();
        }
    }

}