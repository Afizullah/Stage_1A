<?php
if(isset($_REQUEST["id"])){
    $projet_id = secure($_REQUEST["id"]);
}
else {
	die("id du projet non valide");
}
$tab=EC_suggestion::getEC($projet_id);
