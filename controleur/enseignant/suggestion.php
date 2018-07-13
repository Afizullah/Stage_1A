<?php
if(isset($_REQUEST["id"])){
    $id_projet = secure($_REQUEST["id"]);
}
else {
	die("id du projet non valide");
}
$tab=EC_suggestion::getEC($id_projet);
