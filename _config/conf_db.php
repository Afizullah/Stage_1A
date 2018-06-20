<?php
    //Définition des informations de connexion à la base de données
    require_once("../../compte.php");
    define("DB_DSN","mysql:host=localhost; dbname=livret; charset=utf8");
    define("DB_USERNAME","root");
    define("DB_PASSWORD","");
    define("DB_CLASS_FILE","../model/commun/DataObject.class.php");
    define("DB_OPT_FILE","../model/commun/DB.class.php");
?>
