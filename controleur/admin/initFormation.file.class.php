<?php
    require_once(PHPExcel_CLASS_FILE);
    class InitFormationWithFile extends PHPExcel_IOFactory{
        private $document_excel=null;
        private $feuilles = null;
        private $leafColsAllowed = ["Code_Parcours","CodeUE","CodeEC","Semestre","TypeCompetence","Classe","Matiere","Compétences","Preréquis","Contenu",
                                    "Nb Heures CM","Nb Heures TD","Nb Heures TP","Nb Heures TPE","Coefficient","Credit UE"];
        //private $leafColsAllowed = ["prenom","nom","date_de_naissance"];
        public function __construct(){
            $this->document_excel = PHPExcel_IOFactory::load("new.xls");
            $allLeaf = $this->document_excel->getAllSheets();
            foreach ($allLeaf as $leaf) {
                $headLeaf = self::getHeadLeaf($leaf);
                if(!self::isNotCorrectLeaf($headLeaf)){
                    $this->feuilles[self::getFormationName($leaf)]=self::getRequiredData($leaf,$headLeaf);
                }
            }

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
                            if(in_array($headOrder[$cmptIterator],$this->leafColsAllowed)){
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
            for ($i=0; $i < count($this->leafColsAllowed); $i++) {
                if(!in_array($this->leafColsAllowed[$i],$headLeaf)){
                        $cols_not_found[]=$this->leafColsAllowed[$i];
                }
            }
            return $cols_not_found;
        }
        /*public function getFeuille($num){
            if(isset($this->feuilles[$num])){
                return $this->feuilles[$num];
            }
            if(isset(self::getDataFile()[$num])){
                $this->feuilles = self::getDataFile()[$num];
                return self::getDataFile()[$num];
            }
            return null;
        }

        private function getDataFile(){
            return $this->document_excel->getAllSheets();
        }*/
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
        public function trash(){

            /*
            <!DOCTYPE html>
            <html lang="fr-FR">
            	<head>
            		<title>Lire et traiter un fichier excel en PHP</title>
            		<meta charset="utf-8" />
            	</head>
            	<body>




            	$document_excel = PHPExcel_IOFactory::load("new.xls");
        		$allFile = $document_excel->getAllSheets();
        		foreach($allFile as $feuille){
        			var_dump($feuille->getTitle());
        			br();
        			var_dump(getHeadLeaf($feuille));
        			br();
        			br();
        			br();

        		}
                $feuille = $document_excel->getSheet(1);
                var_dump($feuille->getTitle());
            	$compte = 0;
                //echo "<table>";
            	foreach($feuille->getRowIterator() as $ligne){
            		/*echo "<tr>";
            		foreach($ligne->getCellIterator() as $cellule){
            			if($compte == 0){
            				echo "<th>";
            			}else{
            				echo "<td>";
            			}
            			echo $cellule->getValue();
            			if($compte == 0){
            				echo "</th>";
            			}else{
            				echo "</td>";
            			}
            		}
            		echo "</tr>";
        			$compte += 1;

            	}
        		//echo "</table>";

            	?>
            	</body>
            </html>
            */
        }
    }

?>
