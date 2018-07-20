<?php

class UpdateField extends DB
{
    public static function classeName($classId, $newValue) {
        return parent::update("classe", [["classe_nom", $newValue]], [["classe_id", $classId]]);
    }

    //Pour la modification des attributs d'un EC
    public static function ueCode($ueId, $newValue) {
        return parent::update("ue", [["ue_code", $newValue]], [["ue_id", $ueId]]);
    }

    public static function ueNom($ueId, $newValue) {
        return parent::update("ue", [["ue_nom", $newValue]], [["ue_id", $ueId]]);
    }

    public static function ueNbrCred($ueId, $newValue) {
        return parent::update("ue", [["ue_nbre_cred", $newValue]], [["ue_id", $ueId]]);
    }

    public static function ueSemestre($ueId, $newValue) {
        return parent::update("ue", [["ue_semestr", $newValue]], [["ue_id", $ueId]]);
    }

    //Pour la modification des attributs d'un EC
    public static function ecCode($ueId, $newValue) {
        return parent::update("ec", [["ec_code", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecNom($ueId, $newValue) {
        return parent::update("ec", [["ec_nom", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecCompetence($ueId, $newValue) {
        return parent::update("ec", [["ec_competence", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecPrerequis($ueId, $newValue) {
        return parent::update("ec", [["ec_prerequis", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecContenu($ueId, $newValue) {
        return parent::update("ec", [["ec_contenu", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecCoef($ueId, $newValue) {
        return parent::update("ec", [["ec_coef", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecHCM($ueId, $newValue) {
        return parent::update("ec", [["ec_nbre_heure_cm", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecHTD($ueId, $newValue) {
        return parent::update("ec", [["ec_nbre_heure_td", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecHTP($ueId, $newValue) {
        return parent::update("ec", [["ec_nbre_heure_tp", $newValue]], [["ec_id", $ueId]]);
    }

    public static function ecHTPE($ueId, $newValue) {
        return parent::update("ec", [["ec_nbre_heure_tpe", $newValue]], [["ec_id", $ueId]]);
    }
}

?>
