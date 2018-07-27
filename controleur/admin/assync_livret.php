<?php
if (isset($_POST["filename"])){
	if(publier_livret($_POST["filename"])){
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