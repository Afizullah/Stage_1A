<?php
function est_valide($reponse){
	return (strcmp($reponse,"")!=0);
}

$id=array_keys($_POST)[count($_POST)-1];
$i=floor($id/10);
$t=$id % 10;
$sugg_etat="en cours";
$sugg_cible_id=$tab['ec_id'];
if ($t==1){
	$sugg_valeur=$_POST['ec_nom'];
	$sugg_cible='ec_nom';
}
if ($t==2){
	$sugg_valeur=$_POST['ec_competence'];
	$sugg_cible='ec_competence';
}
if ($t==3){
	$sugg_valeur=$_POST['ec_prerequis'];
	$sugg_cible='ec_prerequis';
}
if ($t==4){
	$sugg_valeur=$_POST['ec_contenu'];
	$sugg_cible='ec_contenu';
}
if ($t==5){
	$sugg_valeur=$_POST['ec_coef'];
	$sugg_cible='ec_coef';
}
if ($t==6){
	$sugg_valeur=$_POST['ec_nbre_heure_cm'];
	$sugg_cible='ec_nbre_heure_cm';
}
if ($t==7){
	$sugg_valeur=$_POST['ec_nbre_heure_td'];
	$sugg_cible='ec_nbre_heure_tp';
}
if ($t==8){
	$sugg_valeur=$_POST['ec_nbre_heure_tp'];
	$sugg_cible='ec_nbre_heure_tp';
}
if ($t==9){
	$sugg_valeur=$_POST['ec_nbre_heure_tpe'];
	$sugg_cible='ec_nbre_heure_tpe';
}
echo $sugg_cible_id;
?>