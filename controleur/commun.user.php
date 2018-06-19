<?php

class CurrentUser{

    public static function getId(){
        return $_SESSION[$_SESSION["type_compte"]]["user_id"];
    }

    public static function getAccountId(){
        return $_SESSION[$_SESSION["type_compte"]]["compte_id"];
    }
    public static function getName(){
        return $_SESSION[$_SESSION["type_compte"]]["user_nom"];
    }
    public static function getLastName(){
        return $_SESSION[$_SESSION["type_compte"]]["user_prenom"];
    }
    public static function getFullName(){
        return $_SESSION[$_SESSION["type_compte"]]["user_prenom"]." ".$_SESSION[$_SESSION["type_compte"]]["user_nom"];
    }
    public static function getMail(){
        return $_SESSION[$_SESSION["type_compte"]]["user_mail"];
    }


}



 ?>
