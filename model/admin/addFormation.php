<?php
    class Formation extends DB{
        //Ajoute une formation s'il n'existe pas et de retourne son id
        public static function registreFile($projetId,$data){
            $formations = $data->getFormations();
            $classe = array();
            $errors = array();
            foreach ($formations as $formation => $value) {
                if($semestres = $data->getSemestresForm($formation)){
                    $codeFormat = $data->getCodeFormation($formation);
                    $formation_nbr_semestre = count($semestres);
                    $resp_id=self::deleteFormation($projetId,$formation);
                    $thisInfosFormation = self::addFormation($projetId,$codeFormat,$formation,$formation_nbr_semestre,$resp_id);
                    $currentClass = NULL;
                    if($_formationId = $thisInfosFormation["formationId"]){
                        for ($i=0; $i < count($semestres) ; $i++) {
                            if($ues = $data->getUe($formation,$semestres[$i])){
                                for ($k=0; $k < count($ues["CodeUe"]); $k++){
                                    $thisClass = $ues["thisUeDetailles"][$k]["classe"];
                                    if(!$thisClass){
                                        $thisClass=$currentClass;
                                    }else{
                                        $currentClass=$thisClass;
                                    }
                                    $thisInfosClasse = self::addClasse($_formationId,$thisClass);
                                    if($_classId = $thisInfosClasse["classeId"]){
                                        $codeCurrentUe = $ues["CodeUe"][$k];
                                        $detaillesUe = $ues["thisUeDetailles"][$k];
                                        $thisUeInfos = self::addUe($_classId,$codeCurrentUe,$detaillesUe["CodeUeIntitule"],$detaillesUe["semestre"]);
                                        if($_ueId = $thisUeInfos["ueId"]){
                                            if($ecUe = $data->getEc($formation,$semestres[$i],$ues["CodeUe"][$k])){
                                                for ($i_ec=0; $i_ec < count($ecUe["CodeEC"]); $i_ec++) {
                                                    $codeEc = $ecUe["CodeEC"][$i_ec];
                                                    $competence = $ecUe["competence"][$i_ec];
                                                    $matiere = $ecUe["matiere"][$i_ec];
                                                    $prerequis = $ecUe["prerequis"][$i_ec];
                                                    $contenu = $ecUe["contenu"][$i_ec];
                                                    $coef = $ecUe["coef"][$i_ec];
                                                    $nbrHeurCM = $ecUe["nbrHeurCM"][$i_ec];
                                                    $nbrHeurTD = $ecUe["nbrHeurTD"][$i_ec];
                                                    $nbrHeurTP = $ecUe["nbrHeurTP"][$i_ec];
                                                    $nbrHeurTPE = $ecUe["nbrHeurTPE"][$i_ec];
                                                    $thisInfosEc = self::addEc($_ueId,$codeEc,$matiere,secure($competence),$prerequis,$contenu,$coef,
                                                                                $nbrHeurCM,$nbrHeurTD,$nbrHeurTP,$nbrHeurTPE);
                                                   if(!$thisInfosEc["ecId"]){
                                                       $errors[]=$thisInfosEc["msg"];
                                                   }
                                                }
                                            }
                                        }else{
                                            $errors[]=$thisUeInfos["msg"];
                                        }

                                    }else{
                                        $errors[]=$thisInfosClasse["msg"];
                                    }
                                }
                            }
                        }
                    }else{
                        $errors[]=$thisInfosFormation["msg"];
                    }
                }
            }
            if(empty($errors)){
                $status = true;
            }else{
                $status = false;
            }
            return array(
                "isRegisted"=>$status,
                "errors"=>$errors
            );
        }
        public static function deleteFormation($projetId,$formationName){
            if($resu = DB::getLine("formation","formation_id,user_id",[["projet_id",intval($projetId)],["formation_nom",$formationName]])){
                DB::execute("DELETE FROM formation WHERE formation_id=".intval($resu["formation_id"]));
                return $resu['user_id'];
            }
        }
        public static function addFormation($projectId,$formationCode,$formationNom,$formationSemestre,$resp_id=NULL){
            $msg=null;
            $registed=false;
            if(!$formationId = DB::getLine("formation","formation_id",[["projet_id",$projectId],["formation_code",$formationCode]])["formation_id"]){
                if($formationId = DB::registre("formation",[["projet_id",$projectId],["formation_code",$formationCode],["formation_nom",$formationNom],["formation_semestre",$formationSemestre],["user_id",$resp_id]])){
                    $registed=true;
                }else{
                    $msg = "Echec de l'enregistrement de la formation ".secure($formationCode);
                }
            }else{
                $registed = true;
                $msg = "La formation ".secure($formationCode)." était déja créée";
            }
            return array(
                "formationId"=>$formationId,
                "registed"=>$registed,
                "msg"=>$msg
            );
        }
        public static function getFormations($idProjet){
            return parent::getData("formation","*",[["projet_id",$idProjet]]);
        }
        public static function getInfosFormation($formationId){
            return parent::getLIne("formation","*",[["formation_id",$formationId]]);
        }

        //Ajoute une classe s'il n'existe pas et de retourne son id
        public static function addClasse($formationId,$className){
            $msg=null;
            $registed=false;
            if(!$classeId = DB::getLine("classe","classe_id",[["classe_nom",$className],["formation_id",$formationId]])["classe_id"]){
                if($classeId = DB::registre("classe",[["formation_id",$formationId],["classe_nom",$className]])){
                    $registed=true;
                }else{
                    $msg = "Echec de l'enregistrement de la classe ".secure($className);
                }
            }else{
                $registed = true;
                $msg = "La classe ".secure($className)." était déja créée";
            }
            return array(
                "classeId"=>$classeId,
                "registed"=>$registed,
                "msg"=>$msg
            );
        }
        public static function getClasses($formationId){
            return parent::getData("classe","*",[["formation_id",$formationId]]);
        }

        //Ajoute une UE s'il n'existe pas et de retourne son id
        public static function addUe($classeId,$ueCode,$ueNom,$ueSemestre){
            $msg=null;
            $registed=false;
            if(!$ueId = DB::getLine("ue","ue_id",[["classe_id",$classeId],["ue_code",secure($ueCode)]])["ue_id"]){
                if($ueId = DB::registre("ue",[["classe_id",$classeId],["ue_code",secure($ueCode)],["ue_nom",secure($ueNom)],["ue_semestr",secure($ueSemestre)]])){
                    $registed=true;
                }else{
                    $msg = "Echec de l'enregistrement de la de l'UE ".secure($ueCode);
                }
            }else{
                $registed = true;
                $msg = "L'UE ".secure($ueCode)." était déja créée";
            }
            return array(
                "ueId"=>$ueId,
                "registed"=>$registed,
                "msg"=>$msg
            );
        }

        public static function getUes($classeId){
            return parent::getData("ue","*",[["classe_id",$classeId]]);
        }

        //Ajoute une UE s'il n'existe pas et de retourne son id
        public static function addEc($ueId,$ecCode,$ecNom,$ecCompetence,$ecPrerequis,$ecContenu,$ecCoef,$ecHCM,$ecHTD,$ecHTP,$ecHTPE){
            $msg=null;
            $registed=false;
            if(!$ecId = DB::getLine("ec","ec_id",[["ue_id",$ueId],["ec_code",$ecCode]])["ec_id"]){
                if($ecId = DB::registre("ec",[["ue_id",$ueId],["ec_code",secure($ecCode)],["ec_nom",secure($ecNom)],["ec_competence",secure($ecCompetence)],["ec_prerequis",secure($ecPrerequis)],["ec_contenu",secure($ecContenu)],["ec_coef",secure($ecCoef)],
                                    ["ec_nbre_heure_cm",secure($ecHCM)],["ec_nbre_heure_td",secure($ecHTD)],["ec_nbre_heure_tp",secure($ecHTP)],["ec_nbre_heure_tpe",secure($ecHTPE)]])){
                    $registed=true;
                }else{
                    $msg = "Echec de l'enregistrement de la de l'ec ".secure($ecCode);
                }
            }else{
                $registed = true;
                $msg = "L'EC ".secure($ecCode)." était déja créée";
            }
            return array(
                "ecId"=>$ecId,
                "registed"=>$registed,
                "msg"=>$msg
            );
        }
        public static function getEcs($ueId){
            return parent::getData("ec","*",[["ue_id",$ueId]]);
        }

    }
?>
