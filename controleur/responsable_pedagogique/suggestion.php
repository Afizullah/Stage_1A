<?php
if(isset($_REQUEST["id"])){
    $projet_id = secure($_REQUEST["id"]);
}
else {
	die("ID du projet invalide");
}
$tab=EC_suggestion::getEC($projet_id);
