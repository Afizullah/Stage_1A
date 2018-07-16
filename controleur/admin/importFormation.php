<?php
require_once(PATH_CONTROLEUR."admin/assync.loadFile.php");
if(isset($_REQUEST["importData"])){
    if(isset($_REQUEST["importMethod"])){
        $importMethod = secure($_REQUEST["importMethod"]);
        switch($importMethod){
            case "excelFile":
                if(isset($_REQUEST["formationsSelectedFromExcel"])){
                    $formationsSelected = $_REQUEST["formationsSelectedFromExcel"];
                    $fileName = $_REQUEST["excelFileSource"];
                    if($dataExcel = new LoadFile(PATH_TEMPLATE."dist/xls/".$fileName,$formationsSelected)){
                        if($dataExcel->getFormations()){
                            $resultRegFile = Formation::registreFile($PROJET->getId(),$dataExcel);
                            if($resultRegFile["isRegisted"]){
                               $success = "Importation effectuée avec succès";
                            }else{
                                for ($i=0; $i < count($resultRegFile["errors"]); $i++) {
                                    $errors[]=$resultRegFile["errors"][$i];
                                }
                            }
                        }else{
                            $errors[] = "Aucune formation détectée";
                        }
                    }else{
                        $errors[] = "Echec du chargement du fichier";
                    }
                }else{
                    $errors[] = "Aucune formation selectionnée";
                }
            break;
            case "dbFile":
                if(isset($_REQUEST["formationsSelectedFromDb"])){
                    if(isset($_REQUEST["idProjectToImport"])){
                        $idProjectToImport = intval($_REQUEST["idProjectToImport"]);
                        $formationsSelected = $_REQUEST["formationsSelectedFromDb"];
                        $currentProjectId = $PROJET->getId();
                        $currentCopy = new CopyProject($currentProjectId,$idProjectToImport,$formationsSelected);
                        if($errorsCopy = $currentCopy->getErrors()){
                            for ($i=0; $i < count($errorsCopy) ; $i++) {
                                $errors[]= $errorsCopy[$$i];
                            }
                        }else{
                            $success = "Importation effectuée avec succès";
                        }
                    }else{
                        $errors[] = "Projet introuvable";
                    }
                }else{
                    $errors[] = "Aucune formation selectionnée";
                }
            break;
            default:
                $errors[]="Methode d'importation non déterminé";
            break;
        }
    }
}
?>
