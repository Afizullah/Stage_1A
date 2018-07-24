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
// echo "Bonjour";
$idProject = $PROJET->getId();
if (isset($_POST["addGroup"], $_POST["groupe_nom"])) {
    $groupe_nom = secure($_POST["groupe_nom"]);
    // var_dump($_POST);
    // die();
    if (empty($groupe_nom)) {
        $errors[] = "Veuillez préciser le nom du groupe !!!";
    } else {
        if (DB::getLine("groupe", "*", [["groupe_specialite", $groupe_nom], ["projet_id", $idProject]])) {
            $errors[] = "Un groupe du même nom existe déja !!!";
        }
    }

    if (!isset($errors)) {
        if ($newGroupeId = Group::createGroup($groupe_nom, $idProject)) {
            if (isset($_POST["participants"])) {
                $listeParticipants = $_POST["participants"];
                for ($i = 0; $i < count($listeParticipants); $i++) {
                    $participantId = intval($listeParticipants[$i]);
                    Group::addUser($newGroupeId, $participantId);
                }
            }
            $success = "Groupe créé avec succès";
        } else {
            $errors[] = "Echec de l'enregistrement du groupe";
        }
    }
}

?>
