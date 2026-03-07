<?php

class SessionMan {

    static function getSessionValue($key) {


        session_start();
        $result = isset($_SESSION[$key]) ? $_SESSION[$key] : null;

        return $result;
    }

    static function deleteSessionValue($key) {

        session_start();

        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    static function setSessionValue($value, $key) {

        session_start();
        $_SESSION[$key] = $value;
    }

    static function initSession() {

        session_name(md5('WebID'));
        session_start();
    }

}