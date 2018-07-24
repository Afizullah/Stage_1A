<?php 
if(!isset($_SESSION["livretSession"][0]["compte_typeCompte"]) || $_SESSION["livretSession"][0]["compte_typeCompte"]!="administrateur"){
    header("Location:../");
    die("<center>ERROR::Accès non autorisé</center>");
}
?>