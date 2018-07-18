<?php
require_once PATH_CONTROLEUR.'commun.user.php';
$formations=importForm::getFormations(CurrentUser::getId());
require_once PATH_CONTROLEUR.'admin/assync.loadFile.php';

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
