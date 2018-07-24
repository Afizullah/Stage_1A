<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<center><b>ERROR</b>::Accès non autorisé</center>");
        }
    }else{
        header("Location:../");
        die("<center><b>ERROR</b>::Accès non autorisé</center>");
    }
?>
<div style="background-color:white;min-height:500px" class="col-lg-12">
    <div style="text-align: center;">
        <h3>Modifier information du compte</h3><br>
    </div>
    <div style="width:80%;margin:auto;box-shadow: 0px 1px 25px rgba(0, 0, 0, 0.1);" class="">
