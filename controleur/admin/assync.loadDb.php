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

function getFormationsNames($dataFormation)
{
    $formsNames = array();
    if ($dataFormation) {
        foreach ($dataFormation as $keyFormation => $valsForm) {
            $formsNames[] = $valsForm["formation_nom"];
        }
        return $formsNames;
    } else {
        return false;
    }
}

?>
