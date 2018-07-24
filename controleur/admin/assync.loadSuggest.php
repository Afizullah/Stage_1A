<?php
$suggestionListe = null;
if (isset($_GET["cible"], $_GET["id"])) {
    $tableName = secure($_GET["cible"]);
    $id = intval($_GET["id"]);
    $attrib = secure($_GET["attrib"]);
    switch ($tableName) {
        case 'ue':

            break;
        case 'ec':
            switch ($attrib) {
                case "competence":
                case "prerequis":
                case "nom":
                case "contenu":
                case "coef":
                case "nbre_heure_cm":
                case "nbre_heure_td":
                case "nbre_heure_tp":
                case "nbre_heure_tpe":
                    $realAttribCible = $tableName . "_" . $attrib;
                    if ($suggestionListe = Sugges::getAll($PROJET->getId(), $realAttribCible, $id)) {
                        //var_dump(Sugges::apply(1));
                    }
                    break;
                default:
                    $errors[] = "Opération non autorisée";
                    break;
            }
            break;
        default:
            $errors[] = "Opération non autorisée";
            break;
    }
}
?>
