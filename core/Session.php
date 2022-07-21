<?php 

class Session {

    public static function setSession($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public static function getSession($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }

    public static function unsetSession($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    public static function destroySession(){
        session_destroy();
    }

}

?>