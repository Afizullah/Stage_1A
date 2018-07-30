<?php
$formations=explode("|",($_POST['formations']));
$projet_id=$PROJET->getId();
if (isset($_POST["filename"])){
	if(publ_livret::publier_livret($_POST["filename"],$projet_id,$formations)){
		$html='<p style="color:green">Le livret a été publié</p>';
	}
	else{
		$html='<p style="color:red">Erreur lors de la publication</p>';
	}
}
else{
	$html='<p style="color:red">Erreur fichier non transmis</p>';
}


?>