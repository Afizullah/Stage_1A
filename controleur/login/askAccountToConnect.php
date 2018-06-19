<?php
if(isset($_POST["confirmChoix"],$_POST["choosedAccount"])){
    foreach ($_SESSION["livretSession"] as $sess) {
        if($sess["compte_typeCompte"]==$_POST["choosedAccount"]){
            $_SESSION[$_POST["choosedAccount"]]=$sess;
            $_SESSION["type_compte"]=$_POST["choosedAccount"];
            unset($_SESSION["livretSession"]);
            header("Location:index.php?page=accueil");
            die();
        }
    }
}



 ?>
