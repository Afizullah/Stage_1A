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
<?php
/**
 * Created by PhpStorm.
 * User: Afiz
 * Date: 23/07/2018
 * Time: 15:56
 */
$projetID=$PROJET->getId();
$formations= choixexportFormation::getFormation($projetID);
?>

