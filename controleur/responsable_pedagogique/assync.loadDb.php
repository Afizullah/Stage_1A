<?php
require_once(PATH_CONTROLEUR."admin/assync.loadDb.php");
require_once(PATH_CONTROLEUR."commun.user.php");
$user_id=CurrentUser::getId();
$projet_id=$PROJET->getId();
$formations=importForm::getFormations($user_id,$projet_id);

function inter_formation($formationsNames,$formations){
    $resu=[];
    for($i=0;$i<count($formations);$i++){
        for($j=0;$j<count($formationsNames);$j++){
            if (strcmp($formations[$i]['formation_nom'],$formationsNames[$j])==0){
                $resu[]=$formationsNames[$j];
            }
        }
    }
    return $resu;
}
?>
