<?php
    require_once(PHPExcel_CLASS_FILE);
    class InitFormationWithFile extends PHPExcel_IOFactory{
        private $document_excel=null;
        private $feuilles = array(
                                "cols_not_found" => array(),
                                "data"=>
                            );
        private $leafColsAllowed = ["Code_Parcours","CodeUE","CodeEC","Semestre","TypeCompetence","Classe","Matiere","Compétences","Preréquis","Contenu",
                                    "Nb Heures CM","Nb Heures TD","Nb Heures TP","Nb Heures TPE","Coefficient","Credit UE"];
        public function __construct(){
            $this->document_excel = PHPExcel_IOFactory::load("new.xls");
        }
        public function getFeuille($num){
            if(isset($this->feuilles[$num])){
                return $this->feuilles[$num];
            }
            if(isset(self::getDataFile()[$num])){
                $this->feuilles = self::getDataFile()[$num];
                return self::getDataFile()[$num];
            }
            return null;
        }
        public function getFormationName($leaf){
            return $leaf->getTitle();
        }
        private function getDataFile(){
            return $this->document_excel->getAllSheets();
        }
        public function getHeadLeaf($leaf){
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
