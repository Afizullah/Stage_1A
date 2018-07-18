<?php
$reponse = "";
if(isset($_SESSION["administrateur"])){
    if(isset($_GET["q"],$_GET["val"])){
        $q = secure($_GET["q"]);
        $postInfos = explode("_",$q);
        if(count($postInfos)==2){
            $val = secure($_GET["val"]);
            $attrib = $postInfos[0];
            $id = intval($postInfos[1]);
            switch ($attrib) {
                case _getHashName("classe_nom"):
                    if(UpdateField::classeName($id,$val)){
                        $reponse = "Nom classe modifié avec success";
                    }else{
                        $reponse = "Echec de la modification";
                    }
                    break;
                case _getHashName("ue_code"):
                        if(UpdateField::ueCode($id,$val)){
                            $reponse = "Code UE modifié avec success";
                        }else{
                            $reponse = "Echec de la modification";
                        }
                    break;
                case _getHashName("ue_nom"):
                        if(UpdateField::ueNom($id,$val)){
                            $reponse = "Nom UE modifié avec success";
                        }else{
                            $reponse = "Echec de la modification du nom de l'UE";
                        }
                    break;
                case _getHashName("ue_nbre_cred"):
                        if(UpdateField::ueNbrCred($id,$val)){
                            $reponse = "Nombre de credit UE modifié avec success";
                        }else{
                            $reponse = "Echec de la modification du nombre de credit de l'UE";
                        }
                    break;
                case _getHashName("ue_semestr"):
                        if(UpdateField::ueSemestre($id,$val)){
                            $reponse = "Semestre UE modifié avec success";
                        }else{
                            $reponse = "Echec de la modification du nombre de credit de l'UE";
                        }
                    break;
                case _getHashName("ec_code"):
                        if(UpdateField::ecCode($id,$val)){
                            $reponse = "Code EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification code EC";
                        }
                    break;
                case _getHashName("ec_nom"):
                        if(UpdateField::ecNom($id,$val)){
                            $reponse = "Nom EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification nom EC";
                        }
                    break;
                case _getHashName("ec_competence"):
                        if(UpdateField::ecCompetence($id,$val)){
                            $reponse = "Compétence EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification compétence EC";
                        }
                    break;
                case _getHashName("ec_prerequis"):
                        if(UpdateField::ecPrerequis($id,$val)){
                            $reponse = "Prérequis EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification prérequis EC";
                        }
                    break;
                case _getHashName("ec_contenu"):
                        if(UpdateField::ecContenu($id,$val)){
                            $reponse = "Contenu EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification contenu EC";
                        }
                    break;
                case _getHashName("ec_coef"):
                        if(UpdateField::ecCoef($id,$val)){
                            $reponse = "Coef EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification coef EC";
                        }
                    break;
                case _getHashName("ec_nbre_heure_cm"):
                        if(UpdateField::ecHCM($id,$val)){
                            $reponse = "Nombre d'heure CM EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification Nbr Heure CM EC";
                        }
                    break;
                case _getHashName("ec_nbre_heure_td"):
                        if(UpdateField::ecHTD($id,$val)){
                            $reponse = "Nombre d'heure TD EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification Nbr Heure TD EC";
                        }
                    break;
                case _getHashName("ec_nbre_heure_tp"):
                        if(UpdateField::ecHTP($id,$val)){
                            $reponse = "Nombre d'heure TP EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification Nbr Heure TP EC";
                        }
                    break;
                case _getHashName("ec_nbre_heure_tpe"):
                        if(UpdateField::ecHTPE($id,$val)){
                            $reponse = "Nombre d'heure TPE EC modifié avec success";
                        }else{
                            $reponse = "Echec de la modification Nbr Heure TPE EC";
                        }
                    break;

                default:
                        $reponse = "Changements non prise en compte";
                    break;
            }
        }else{
            $reponse = "Formulaire corrompu";
        }
    }else{
        $reponse = "Access denied";
    }
}else{
    $reponse = "Access denied";
}
 ?>
