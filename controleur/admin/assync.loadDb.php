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
