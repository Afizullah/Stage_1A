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
require_once(PHPExcel_CLASS_FILE);
require_once(PATH_MODEL."responsable_pedagogique/assync.loadFile.php");
class LoadFile extends PHPExcel_IOFactory{
    private $document_excel=null;
    private $feuilles = null;
    private $semestre_str = "Semestre";
    private $leafColsRequired = ["Code_Parcours","CodeUE","CodeEC","Semestre","Classe","Matiere","Compétences","Preréquis","Contenu","Nb Heures CM","Nb Heures TD","Nb Heures TP","Nb Heures TPE","Coefficient"];
    private $semestres = null;
    private $ue = null;
    private $ec = null;
    private $codeFormation = null;
    private $currentFormId = null;
    private $current = null;
    public function __construct($file,$selectedFormations=array()){
        $this->document_excel = PHPExcel_IOFactory::load($file);
        $allLeaf = $this->document_excel->getAllSheets();
        foreach ($allLeaf as $leaf) {
            $code_parcours=$leaf->getCell('A2')->getValue();
            $nom=importForm::getNomFromCode($code_parcours);
            if (count($nom)!=0){
                $leaf->setTitle($nom[0]['formation_nom']);
            }
            $formationName = self::getFormationName($leaf);
            $headLeaf = self::getHeadLeaf($leaf);
            if($selectedFormations){
                if(in_array($formationName,$selectedFormations)){
                    if(!self::isNotCorrectLeaf($headLeaf)){
                        $this->feuilles[$formationName]=self::getRequiredData($leaf,$headLeaf);
                        $_SESSION[$formationName]=$this->feuilles[$formationName];
                        self::initAllData($formationName,$this->feuilles[$formationName]);
                    }
                }
            }else{
                if(!self::isNotCorrectLeaf($headLeaf)){
                    $this->feuilles[$formationName]=self::getRequiredData($leaf,$headLeaf);
                    $_SESSION[$formationName]=$this->feuilles[$formationName];
                    self::initAllData($formationName,$this->feuilles[$formationName]);
                }
            }

        }

    }
    private function getSemestreUe($codeUe,$feuille){
        $name = null;
        $sem = null;
        for ($i=0; $i < count($feuille); $i++) {
            if(trim($feuille[$i]["CodeUE"])==trim($codeUe)){
                if(empty($feuille[$i]["CodeEC"])){
                    if(!$name){
                        $name=  $feuille[$i]["Matiere"];
                    }
                }
                if(!empty($feuille[$i]["Semestre"])){
                    if(!$sem){
                        $sem = $feuille[$i]["Semestre"];
                    }
                }
                if($sem && $name){
                    $classe = $feuille[$i]["Classe"];
                    $semestre = $feuille[$i]["Semestre"];
                    return array(
                        "ueSemestre"=>$sem,
                        "ueDetailles"=>array(
                            "CodeUeIntitule"=>$name,
                            "classe"=>$classe,
                            "semestre"=>intval($semestre)
                        )
                    );
                }
            }
        }
        return null;
    }
    private function initAllData($formation,$feuille){
        $sem = array();
        $ue = array();
        $ue_fetch = array();
        $ec = array();
        $ec_fetch = array();
        $thisUeSemestre = 0;
        for ($i=1; $i < count($feuille)-1; $i++) {
            if(!isset($this->codeFormation[$formation])){
                $this->codeFormation[$formation]=$feuille[$i]["Code_Parcours"];
                break;
            }
        }
        for ($i=0; $i < count($feuille); $i++) {
            if(isset($feuille[$i]["Semestre"])){

                $currentSem = trim($feuille[$i]["Semestre"]);
                if(!empty($currentSem)){
                    if(!in_array($currentSem,$sem)){
                        $sem[]=$currentSem;
                    }
                }
                $currentUe = trim($feuille[$i]["CodeUE"]);
                if(!empty($currentUe)){
                    if(!in_array($currentUe,$ue_fetch)){
                        if($thisUeSemestreInfos = self::getSemestreUe($currentUe,$feuille)){
                            $thisUeSemestre=$thisUeSemestreInfos["ueSemestre"];
                            $thisUeDetailles=$thisUeSemestreInfos["ueDetailles"];
                            $ue[$thisUeSemestre]["CodeUe"][]=$currentUe;
                            $ue[$thisUeSemestre]["thisUeDetailles"][]=$thisUeDetailles;
                        }
                        $ue_fetch[]=$currentUe;
                    }
                    $currentEcCode = trim($feuille[$i]["CodeEC"]);

                    if(!empty($currentEcCode) && $thisUeSemestre){
                        if(!in_array($currentEcCode,$ec_fetch)){
                            $currentEcMatiere = $feuille[$i]["Matiere"];
                            $currentEcCompetences = trim($feuille[$i]["Compétences"]);
                            $currentEcPrerequis = trim($feuille[$i]["Preréquis"]);
                            $currentEcContenu = trim($feuille[$i]["Contenu"]);
                            $currentEcCoef = intval($feuille[$i]["Coefficient"]);
                            $currentEcHeuresCM = intval($feuille[$i]["Nb Heures CM"]);
                            $currentEcHeuresTD = intval($feuille[$i]["Nb Heures TD"]);
                            $currentEcHeuresTP = intval($feuille[$i]["Nb Heures TP"]);
                            $currentEcHeuresTPE = intval($feuille[$i]["Nb Heures TPE"]);

                            $ec[$thisUeSemestre][$currentUe]["CodeEC"][]=$currentEcCode;
                            $ec[$thisUeSemestre][$currentUe]["competence"][]=$currentEcCompetences;
                            $ec[$thisUeSemestre][$currentUe]["matiere"][]=$currentEcMatiere;
                            $ec[$thisUeSemestre][$currentUe]["prerequis"][]=$currentEcPrerequis;
                            $ec[$thisUeSemestre][$currentUe]["contenu"][]=$currentEcContenu;
                            $ec[$thisUeSemestre][$currentUe]["coef"][]=$currentEcCoef;
                            $ec[$thisUeSemestre][$currentUe]["nbrHeurCM"][]=$currentEcHeuresCM;
                            $ec[$thisUeSemestre][$currentUe]["nbrHeurTD"][]=$currentEcHeuresTD;
                            $ec[$thisUeSemestre][$currentUe]["nbrHeurTP"][]=$currentEcHeuresTP;
                            $ec[$thisUeSemestre][$currentUe]["nbrHeurTPE"][]=$currentEcHeuresTPE;
                        }
                    }
                }
            }
        }
        $this->semestres[$formation]=$sem;
        $this->ue[$formation] = $ue;
        $this->ec[$formation] = $ec;
    }
    public function getSemestresForm($formation){
        if(isset($this->semestres[$formation])){
            return $this->semestres[$formation];
        }
        return null;
    }
    public function getRequiredHeadLeaft(){
        return $this->leafColsRequired;
    }
    public function getUe($formation,$semestre){
        if(isset($this->ue[$formation][$semestre])){
            return $this->ue[$formation][$semestre];
        }
        return null;
    }
    public function getEc($formation,$semestre,$ue){
        if(isset($this->ec[$formation][$semestre][$ue])){
            return $this->ec[$formation][$semestre][$ue];
        }
        return null;
    }
    public function getCodeFormation($formation){
        if(isset($this->codeFormation[$formation])){
            return $this->codeFormation[$formation];
        }
        return null;
    }
    private function getRequiredData($leaf,$headLeaf){
        $compte=0;
        $headOrder=null;
        $cmptOrder=0;
        $i=0;
        $data=null;
        foreach($leaf->getRowIterator() as $ligne){
            $cmptIterator=0;
            $line=null;
            $k=0;
            $loadThisLine=false;
            foreach($ligne->getCellIterator() as $cellule){
                if($k==0 && $cellule->getValue()){
                    $loadThisLine=true;
                }
                if($loadThisLine){
                    if($compte != 0){
                        if(in_array($headOrder[$cmptIterator],$this->leafColsRequired)){
                            $line[$headOrder[$cmptIterator]]=$cellule->getValue();
                        }
                        $cmptIterator++;
                    }else{
                        $headOrder[$cmptOrder]=$cellule->getValue();
                        $cmptOrder++;
                    }
                }
                $k++;
            }
            $compte += 1;
            if($line){
                $data[]=$line;
            }
        }
        return $data;
    }
    public function getFormations(){
        return $this->feuilles;
    }
    public function getFormationsNames(){
        $formsNames = array();
        if($formations = self::getFormations()){
            foreach ($formations as $keyFormation => $valsForm) {
                    $formsNames[]=$keyFormation;
            }
            return $formsNames;
        }else{
            return false;
        }
    }
    private function isNotCorrectLeaf($headLeaf){
        $cols_not_found = array();
        for ($i=0; $i < count($this->leafColsRequired); $i++) {
            if(!in_array($this->leafColsRequired[$i],$headLeaf)){
                    $cols_not_found[]=$this->leafColsRequired[$i];
            }
        }
        return $cols_not_found;
    }

    private function getFormationName($leaf){
        return $leaf->getTitle();
    }
    private function getHeadLeaf($leaf){
        $titles=array();
        foreach($leaf->getRowIterator() as $firstLine){
            foreach($firstLine->getCellIterator() as $cellule){
                if($cellule->getValue()){
                    $titles[]=$cellule->getValue();
                }

            }
            break;
        }
        return $titles;
    }

}
?>
