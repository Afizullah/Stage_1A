<?php
if(isset($_POST["confirmChoix"],$_POST["choosedAccount"])){
    foreach ($_SESSION["livretSession"] as $sess) {
        if($sess["compte_typeCompte"]==$_POST["choosedAccount"]){
            $_SESSION[$_POST["choosedAccount"]]=$sess;
            header("Location:index.php?page=accueil");
        }
    }
}



 ?>
