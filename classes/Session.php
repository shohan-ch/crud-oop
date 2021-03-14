<?php
class Session{

    public static function int(){
        session_start();
    }
    public static function sessionSet($name,$value){
        $_SESSION[$name] = $value;
    }

    public static function sessionGet($name){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }else{
            return false;
        }
    }
    public static function sessionCheck($name){
        $session = self::sessionGet($name);
        if(!$session){
            header("location:index.php");
        }
    }
    public static function loginPageSession($name){
        $session = self::sessionGet($name);
        if($session){
            header("Location:index.php");
        }
            
    }
    public static function destroy(){
        session_destroy();
        session_unset();
        header("Location:index.php");
    }




}
