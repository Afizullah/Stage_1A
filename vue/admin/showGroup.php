<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
        }
    }else{
        header("Location:../");
        die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
    }
?>