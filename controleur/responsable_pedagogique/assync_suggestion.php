<?php
require_once(PATH_CONTROLEUR . "commun.user.php");

function genere_id($suggestions)
{
    if (count($suggestions) == 0) {
        return 1;
    } else {
        return $suggestions[count($suggestions) - 1]['suggestion_id'] + 1;
    }
}

function est_suggestion($sugg_cible_id, $sugg_cible, $sugg_valeur)
{
    if ($sugg_cible_id == 0) {
        return true;
    } else {
        if (strcmp($sugg_cible, 'ue_nom') == 0) {
            $resu = suggestion::non_suggestion_ue($sugg_valeur, $sugg_cible_id);
            return (count($resu) == 0);
        }
        $resu = suggestion::non_suggestion($sugg_valeur, $sugg_cible_id, $sugg_cible);
        return (strcmp($resu[0][$sugg_cible], $sugg_valeur) != 0);
    }
}

function est_valide($sugg_etat, $sugg_cible_id, $sugg_cible, $sugg_valeur, $user_id, $projet_id)
{
    $suggestions = suggestion::getSuggestion();
    $sugg_id = genere_id($suggestions);
    if (strcmp($sugg_valeur, "") == 0) {
        return '<font color="red">Votre suggestion est invalide (vide)</font>';
    } else
        for ($i = 0; $i < count($suggestions); $i++) {
            if (strcmp($sugg_cible_id, $suggestions[$i]['suggestion_cible_id']) == 0 && strcmp($sugg_cible, $suggestions[$i]['suggestion_cible']) == 0 && strcmp($sugg_valeur, $suggestions[$i]['suggestion_valeur']) == 0) {
                return '<font color="red">Votre suggestion a déjà été faite</font>';
            }
        }
    if (!est_suggestion($sugg_cible_id, $sugg_cible, $sugg_valeur)) {
        return '<font color="red">Votre suggestion est déjà appliquée</font>';
    }
    if (suggestion::registre_sugg($sugg_id, $sugg_cible, $sugg_cible_id, $sugg_valeur, $sugg_etat) == 0) {
        return '<font color="red">Erreur pendant l\'enregistrement dans la base de donnés(suggestion)</font>';
    }
    suggestion::registre_sugg_user($sugg_id, $user_id, $projet_id);
    return '<font color="green">Votre suggestion a bien été prise en compte</font>';
}

$user_id = CurrentUser::getId();
$id = $_POST['label'];
$sugg_etat = "en cours";
$projet_id = $_POST['projet_id'];
if ($id == -0.5) {
    $sugg_valeur = $_POST['general'];
    $sugg_cible = "general";
    $sugg_cible_id = 0;
} else {
    $i = floor($id / 10);
    $t = ($id - 0.5) % 10;
    $sugg_cible_id = $_POST['cible_id'];
    if ($t == 0) {
        $sugg_valeur = $_POST['ue_nom'];
        $sugg_cible = 'ue_nom';
    }
    if ($t == 1) {
        $sugg_valeur = $_POST['ec_nom'];
        $sugg_cible = 'ec_nom';
    }
    if ($t == 2) {
        $sugg_valeur = $_POST['ec_competence'];
        $sugg_cible = 'ec_competence';
    }
    if ($t == 3) {
        $sugg_valeur = $_POST['ec_prerequis'];
        $sugg_cible = 'ec_prerequis';
    }
    if ($t == 4) {
        $sugg_valeur = $_POST['ec_contenu'];
        $sugg_cible = 'ec_contenu';
    }
    if ($t == 5) {
        $sugg_valeur = $_POST['ec_coef'];
        $sugg_cible = 'ec_coef';
    }
    if ($t == 6) {
        $sugg_valeur = $_POST['ec_nbre_heure_cm'];
        $sugg_cible = 'ec_nbre_heure_cm';
    }
    if ($t == 7) {
        $sugg_valeur = $_POST['ec_nbre_heure_td'];
        $sugg_cible = 'ec_nbre_heure_tp';
    }
    if ($t == 8) {
        $sugg_valeur = $_POST['ec_nbre_heure_tp'];
        $sugg_cible = 'ec_nbre_heure_tp';
    }
    if ($t == 9) {
        $sugg_valeur = $_POST['ec_nbre_heure_tpe'];
        $sugg_cible = 'ec_nbre_heure_tpe';
    }
}
$resu = est_valide($sugg_etat, $sugg_cible_id, $sugg_cible, $sugg_valeur, $user_id, $projet_id);