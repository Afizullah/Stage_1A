<?php
    require_once(PHPExcel_CLASS_FILE);
    class InitFormationWithFile extends PHPExcel_IOFactory{
        private $document_excel=null;
        private $feuilles = null;
        private $semestre_str = "Semestre";
        private $leafColsRequired = ["Code_Parcours","CodeUE","CodeEC","Semestre","TypeCompetence","Classe","Matiere","Compétences","Preréquis","Contenu",
                                    "Nb Heures CM","Nb Heures TD","Nb Heures TP","Nb Heures TPE","Coefficient","Credit UE"];
        private $semestres = null;
        private $ue = null;
        private $ec = null;
        //private $leafColsRequired = ["prenom","nom","date_de_naissance"];
        public function __construct(){
            $this->document_excel = PHPExcel_IOFactory::load("new.xls");
            $allLeaf = $this->document_excel->getAllSheets();
            foreach ($allLeaf as $leaf) {
                $formationName = self::getFormationName($leaf);
                if(!isset($_SESSION[$formationName])){
                    $headLeaf = self::getHeadLeaf($leaf);
                    if(!self::isNotCorrectLeaf($headLeaf)){
                        $this->feuilles[$formationName]=self::getRequiredData($leaf,$headLeaf);
                        $_SESSION[$formationName]=$this->feuilles[$formationName];
                        self::initSemestres($formationName,$this->feuilles[$formationName]);
                    }
                }else{
                    $this->feuilles[$formationName]=$_SESSION[$formationName];
                    self::initSemestres($formationName,$this->feuilles[$formationName]);
                }
            }

        }

        private function initSemestres($formation,$feuille){
            $sem = array();
            $ue = array();
            for ($i=0; $i < count($feuille); $i++) {
                if(isset($feuille[$i]["Semestre"])){
                    $currentSem = trim($feuille[$i]["Semestre"]);
                    if(!empty($currentSem) && !in_array($currentSem,$sem)){
                        $sem[]=$currentSem;
                        
                    }
                }
            }
            $this->semestres[$formation]=$sem;
        }
        public function getSemestresForm($formation){
            if(isset($this->semestres[$formation])){
                return $this->semestres[$formation];
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
