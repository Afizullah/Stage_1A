<?php
require_once PATH_CONTROLEUR.'commun.user.php';
$groupes=Groupe::getGroupes(CurrentUser::getId());

/*function tab_groupes($gpes){
	if (count($gpes)==0){
		$html="aucun groupe";
	}
	else{
		$html=	'<table border="1">
					<tr>
						<th> Nom du projet </th>
						<th> Etat du projet </th>
						<th> Spécialité du groupe </th>
					</tr>';
		for ($i=0;$i<count($gpes);$i++){
			$html.="
			<tr> 
				<td> ".$gpes[$i]['projet_nom']." </td>
				<td> ".$gpes[$i]['projet_etat']." </td>
				<td> ".$gpes[$i]['groupe_specialite']." </td>
			</tr>";
		}
	}
	return $html;
}*/
?>