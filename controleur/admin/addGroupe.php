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
            $errors[] = "Échec de l'enregistrement du groupe";
        }
    }
}

?>
