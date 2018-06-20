<?php
if(session_id()==""){session_start();}
if(isset($_REQUEST["confirmChoix"],$_REQUEST["choosedAccount"])){
    foreach ($_SESSION["livretSession"] as $sess) {
        if($sess["compte_typeCompte"]==$_REQUEST["choosedAccount"]){
            if(isset($_REQUEST["currentSess"],$_SESSION[$_REQUEST["currentSess"]])){
                unset($_SESSION[$_REQUEST["currentSess"]]);
            }
            $_SESSION[$_REQUEST["choosedAccount"]]=$sess;
            $_SESSION["type_compte"]=$_REQUEST["choosedAccount"];
            header("Location:index.php?page=accueil");
            die();
        }
    }
}



 ?>
