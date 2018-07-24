<?php

Class Participants extends DB
{
    function getParticipantsInGroup($groupId) {
        return DB::query('SELECT user_nom, user_prenom, user_mail FROM utilisateurs INNER JOIN compte
                            ON compte.user_id = utilisateurs.user_id INNER JOIN groupe_utilisateurs ON groupe_utilisateurs.user_id = utilisateurs.user_id
                            WHERE compte.compte_typeCompte = "enseignant" AND groupe_utilisateurs.groupe_id =' . $groupId);
    }

    function getParticipantsWithoutGroup($idProjet) {
        $groupId = self::getGroupId($idProjet);
        $userWithoutId = array();
        $listeEnseignant = DB::query("SELECT user_nom, user_prenom, utilisateurs.user_id FROM utilisateurs INNER JOIN compte 
                            ON compte.user_id = utilisateurs.user_id WHERE compte.compte_typeCompte='enseignant' 
                            ");
        for ($i = 0; $i < count($groupId); $i++) {
            $userWithGroup = DB::getData("groupe_utilisateurs", "*", [["groupe_id", intval($groupId[$i]["groupe_id"])]]);
            for ($j = 0; $j < count($listeEnseignant); $j++) {
                if ($result = self::isNotInList($userWithGroup, $listeEnseignant[$j])) {
                    $userWithoutId[] = $result;
                }
            }
        }
        return $userWithoutId;
    }

    function getGroupId($idProjet) {
        return DB::query("SELECT groupe_id FROM groupe WHERE projet_id =" . $idProjet);
    }

    function isNotInList($list, $element) {
        for ($i = 0; $i < count($list); $i++) {
            if ($list[$i]["user_id"] == $element["user_id"]) {
                return false;
            }
        }
        return $element;
    }

    function recordGroup($groupId, $userId) {
        return DB::registre("groupe_utilisateurs", [["groupe_id", $groupId], ["user_id", $userId]]);
    }
}

?>