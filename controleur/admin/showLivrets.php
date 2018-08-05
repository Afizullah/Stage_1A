<?php
$filelocation_gen = PATH_MODEL."livret-pdf/";
$html="";
if ($keys=array_keys($_POST)){
	$projet_id=$keys[count($_POST)-1];
	for ($i=0;$i<count($_POST)-1;$i++){
		//récupération du nom des formations à travers le nom de la checkbox
		$filename=explode("X",$keys[$i])[0];
		$formations=explode("_",$filename);
		array_shift($formations);
		showLivrets::FormationDepublie($formations,$projet_id);
		if (showLivrets::deleteLivret($filename,$projet_id)){
			$html="<p style='color:green'>Les livrets selectionnés ont bien été supprimés</p>";
		}
		else {
			$html="<p style='color:red'> erreur lors de la suppression des fichiers</p>";
		}
	}
}
?>