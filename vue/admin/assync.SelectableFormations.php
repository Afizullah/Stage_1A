<?php
var_dump($PROJET->getFormations());
if(isset($_REQUEST["projectToImport"])){
    $projectToImport = intval($_REQUEST["projectToImport"]);
    
}
$PROJET_TO_Import = new Projet();

 ?>
