<?php
require_once(PATH_CONTROLEUR."commun.user.php");
if(isset($_POST["supprimerElement"],$_POST["tknDel"],$_POST["tkDelId"],$_POST["password"])){
    $tableCible = secure($_POST["tknDel"]);
    $idCible = intval($_POST["tkDelId"]);
    $password = _hash($_POST["password"]);
    if(DB::getLine("utilisateurs","user_id",[["user_id",intval(CurrentUser::getId())],["user_mdpasse",$password]])){
        switch ($tableCible) {
            case _getHashName("formation"):
                if(EditFormation::deleteFormation($idCible)){
                    $success = "Formation supprimée avec succès";
                }else{
                    $errors[]="Echec de la suppression de la formation.";
                }
                break;
            case _getHashName("ue"):
                if(EditFormation::deleteUe($idCible)){
                    $success = "UE supprimée avec succès";
                }else{
                    $errors[]="Echec de la suppression de l'UE.";
                }
                break;
            case _getHashName("ec"):
                if(EditFormation::deleteEc($idCible)){
                    $success = "EC supprimée avec succès";
                }else{
                    $errors[]="Echec de la suppression de l'EC.";
                }
                break;

            default:
                $errors[]="Opération non autorisée";
                break;
        }
    }else{
        $errors[]="Echec de la suppression : Compte non identifié";
    }
}
?>
