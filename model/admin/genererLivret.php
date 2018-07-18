<?php
class LMD extends DB{
    private  $nbrHeuresCorrectSemestre = 600;
    private $tabCorrectFormations=null;
    private $tabIncorrectFormations=null;
    private $dataProjet=array();
    private $formations = array();
    private $formationsName = array();
    private $classes=array();
    private $semestres = array();
    private $nbrHeures = array();
    private $coefNullInSemestre = array();
    private $formationsEligible = array();
    private $formationsNonEligibles = array();
    function __construct($projetId){
        if($data = DB::getData("ec NATURAL JOIN ue NATURAL JOIN classe NATURAL JOIN formation","*",[["projet_id",intval($projetId)]])){
            $cmp_form=0;
            $cmp_cls=0;
            $cmp_sem=0;
            $this->dataProjet = $data;
            for ($i=0; $i <count($data) ; $i++) {
                if(!in_array($data[$i]["formation_id"],$this->formations)){
                    $this->formations[$data[$i]["formation_id"]]=$data[$i]["formation_id"];
                    $this->formationsName[$data[$i]["formation_id"]]=($data[$i]["formation_nom_complet"])?$data[$i]["formation_nom_complet"]:$data[$i]["formation_nom"];
                    $cmp_form = $data[$i]["formation_id"];
                    $this->classes[$cmp_form][]=$data[$i]["classe_id"];
                    $cmp_cls =  $data[$i]["classe_id"];;
                    $this->semestres[$cmp_form][$cmp_cls][] = $data[$i]["ue_semestr"];
                }
                if($this->formations){
                    if(!in_array($data[$i]["classe_id"],$this->classes[$cmp_form])){
                        $this->classes[$cmp_form][]=$data[$i]["classe_id"];
                    }
                    if(!in_array($data[$i]["ue_semestr"],$this->semestres[$cmp_form][$cmp_cls])){
                         $this->semestres[$cmp_form][$cmp_cls][] = $data[$i]["ue_semestr"];
                    }
                    $cmp_sem = $data[$i]["ue_semestr"];
                    if(!isset($this->nbrHeures[$cmp_form][$cmp_cls][$cmp_sem])){
                        $this->nbrHeures[$cmp_form][$cmp_cls][$cmp_sem] = 0;
                    }
                    if(!isset($this->coefNullInSemestre[$cmp_form][$cmp_cls][$cmp_sem])){
                        $this->coefNullInSemestre[$cmp_form][$cmp_cls][$cmp_sem] = false;
                    }
                    $this->nbrHeures[$cmp_form][$cmp_cls][$cmp_sem] += $data[$i]["ec_nbre_heure_cm"] + $data[$i]["ec_nbre_heure_td"] + $data[$i]["ec_nbre_heure_tp"] + $data[$i]["ec_nbre_heure_tpe"];
                    if($data[$i]["ec_coef"]==0){
                        $this->coefNullInSemestre[$cmp_form][$cmp_cls][$cmp_sem] = true;
                    }
                }
            }
            foreach ($this->formations as $key => $formationId) {

                self::runStatusFormation($formationId);
            }

        }
    }
    private function runStatusFormation($formationId){
        $classes = self::getClasses($formationId);
        $eligible = true;
        $errors=array();
        if($classes){
            foreach ($classes as $classKey => $classId) {
                if($semestres = self::getSemestres($formationId,$classId)){
                    foreach ($semestres as $semestrKey => $semestre) {

                        if($nbrHeures = self::getNbrHr($formationId,$classId,$semestre)){
                            if($nbrHeures==$this->nbrHeuresCorrectSemestre){

                            }else{
                                $eligible=false;
                                $errors[]="Le volume horaire total ($nbrHeures) du semeste ".$semestre." doit être égal à ".$this->nbrHeuresCorrectSemestre;
                            }
                        }else{
                            $eligible=false;
                            $errors[]="Aucun crenaux horaire";
                        }
                        if(self::hasCoeffNull($formationId,$classId,$semestre)){
                            $eligible=false;
                            $errors[]="Le coefficient de semestre ".$semestre." ne doit pas être 0";
                        }
                    }
                }
            }
        }else{
            $eligible=false;
            $errors[]="Aucune classe détéctée";
        }
        if($eligible){
            $this->formationsEligible[]=array(
                "formationId"=>$this->formations[$formationId],
                "formationName"=>$this->formationsName[$formationId]
            );
        }else{
            $this->formationsNonEligibles[]=array(
                "formationId"=>$formationId,
                "formationName"=>$this->formationsName[$formationId],
                "errors"=>$errors
            );

        }
    }
    public function getEligibleFormations(){
        return $this->formationsEligible;
    }
    public function getNotEligibleFormations(){
        return $this->formationsNonEligibles;
    }

    private function getFormationName($formationId){
        if(isset($this->formationsName[$formationId])){
            return $this->formationsName[$formationId];
        }
        return "Indefined Name".$formationsName;
    }

    private function getDataFormations(){
        return $this->dataProjet;
    }
    private function getFormations(){
        return $this->formations;
    }
    private function getClasses($formationId){
        if(isset($this->classes[$formationId])){
            return $this->classes[$formationId];
        }
        return null;
    }
    private function getNbrHr($formationId,$classeId,$SemestreId){
        return $this->nbrHeures[$formationId][$classeId][$SemestreId];
    }
    public function getSemestres($formationId,$classeId){
        if(isset($this->semestres[$formationId][$classeId])){
            return $this->semestres[$formationId][$classeId];
        }
        return null;
    }
    private function hasCoeffNull($formationId,$classeId,$SemestreId){
        return $this->coefNullInSemestre[$formationId][$classeId][$SemestreId];
    }
}
?>
