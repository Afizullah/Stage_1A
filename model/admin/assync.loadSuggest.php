<?php
    class Sugges extends DB{
            public static function getAll($projetId,$realCible,$idCible){
                return DB::getData("suggestions_projet_utilisateur NATURAL JOIN suggestions NATURAL JOIN utilisateurs NATURAL JOIN projet","suggestion_id,user_nom,user_prenom,user_mail,suggestion_valeur",[["projet_id",intval($projetId)],["suggestion_etat","en cours"],["suggestion_cible",$realCible],["suggestion_cible_id",$idCible]]);
            }
            public static function apply($suggestionId){
                if($suggestion = DB::getLine("suggestions","*",[["suggestion_id",intval($suggestionId)]])){
                    $attrib = $suggestion["suggestion_cible"];
                    $table = explode("_",$attrib)[0];
                    $tableSuggestionAllowed = ["ec","ue"];
                    if(in_array($table,$tableSuggestionAllowed)){
                        $elementId = intval($suggestion["suggestion_cible_id"]);
                        $idName = $table."_id";
                        if($elementToModify = DB::getLine($table,"*",[[$idName,$elementId]])){
                            $newValue = $suggestion["suggestion_valeur"];
                            if(DB::update($table,[[$attrib,$newValue]],[[$idName,$elementId]])){
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
    }
?>
