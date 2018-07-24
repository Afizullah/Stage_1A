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
require_once(PATH_CONTROLEUR . "commun.user.php");
if (isset($_POST["supprimerElement"], $_POST["tknDel"], $_POST["tkDelId"], $_POST["password"])) {
    $tableCible = secure($_POST["tknDel"]);
    $idCible = intval($_POST["tkDelId"]);
    $password = _hash($_POST["password"]);
    if (DB::getLine("utilisateurs", "user_id", [["user_id", intval(CurrentUser::getId())], ["user_mdpasse", $password]])) {
        switch ($tableCible) {
            case _getHashName("formation"):
                if (EditFormation::deleteFormation($idCible)) {
                    $success = "Formation supprimée avec succès";
                } else {
                    $errors[] = "Echec de la suppression de la formation.";
                }
                break;
            case _getHashName("ue"):
                if (EditFormation::deleteUe($idCible)) {
                    $success = "UE supprimée avec succès";
                } else {
                    $errors[] = "Echec de la suppression de l'UE.";
                }
                break;
            case _getHashName("ec"):
                if (EditFormation::deleteEc($idCible)) {
                    $success = "EC supprimée avec succès";
                } else {
                    $errors[] = "Echec de la suppression de l'EC.";
                }
                break;

            default:
                $errors[] = "Opération non autorisée";
                break;
        }
    } else {
        $errors[] = "Echec de la suppression : Compte non identifié";
    }
}
?>
