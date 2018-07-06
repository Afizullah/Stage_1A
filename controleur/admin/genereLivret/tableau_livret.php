<?php
//==================================
//	Fonctions tableau des matières
//==================================

function tab_entete(){
	$contenu='<link rel="stylesheet" href="'.PATH_TEMPLATE.'/dist/css/tab_matieres.css" type="text/css">';
	$contenu.='<table class="tab_matieres">';
	$contenu.=<<<Tab
	<tr>
		<th width="30%">Matieres</th>
		<th width="10%">Nb d'heures CM</th>
		<th width="10%">Nb d'heures TD</th>
		<th width="10%">Nb d'heures TP</th>
		<th width="10%">Nb d'heures TPE</th>
		<th width="10%">Nb d'heures Total</th>
		<th width="10%">Coeff</th>
		<th width="10%">Credit UE</th>
	</tr>
Tab;
	return $contenu;
}

function tab_module($module,$nbr_heures_cm,$nbr_heures_td,$nbr_heures_tp,$nbr_heures_tpe,$coef){
	$HT=$nbr_heures_cm+$nbr_heures_td+$nbr_heures_tp+$nbr_heures_tpe;
	$contenu='<tr class="modules">';
	$contenu.=<<<Tab
		<td>$module</td>
		<td>$nbr_heures_cm</td>
		<td>$nbr_heures_td</td>
		<td>$nbr_heures_tp</td>
		<td>$nbr_heures_tpe</td>
		<td>$HT</td>
		<td>$coef</td>
		<td> </td>
	</tr>
Tab;
	return $contenu;
}

function tab_ue($ue,$SumHCM,$SumHTD,$SumHTP,$SumHTPE,$SumtotH,$Cred){
	$contenu='<tr class="ue">';
	$contenu.=<<<Tab
		<td>$ue</td>
		<td>$SumHCM</td>
		<td>$SumHTD</td>
		<td>$SumHTP</td>
		<td>$SumHTPE</td>
		<td>$SumtotH</td>
		<td> </td>
		<td>$Cred</td>
	</tr>
Tab;
	return $contenu;
}

function tab_semestre($n_semestre,$SumHCM,$SumHTD,$SumHTP,$SumHTPE,$SumtotH){
	$contenu='<tr class="semestre">';
	$contenu.=<<<Tab
		<td>SEMESTRE $n_semestre</td>
		<td>$SumHCM</td>
		<td>$SumHTD</td>
		<td>$SumHTP</td>
		<td>$SumHTPE</td>
		<td>$SumtotH</td>
		<td> </td>
		<td>30</td>
	</tr>
Tab;
	return $contenu;
}

function tab_fin($Tcm,$Ttd,$Ttp,$Ttpe,$TT,$Tcred){
$resu=<<<Tab
	<tr>
		<td> </td>
		<td>$Tcm</td>
		<td>$Ttd</td>
		<td>$Ttp</td>
		<td>$Ttpe</td>
		<td>$TT</td>
		<td> </td>
		<td>$Tcred</td>
	</tr>
	</table>
Tab;
	return $resu;
}

/*Génération de tableaux de details des modules, comme à partir de la page 16 jusqu'à la page 32.

@param Les arguments sont des tableaux avec les modules regroupés par l'ue à laquelle ils appartiennent et par semestre dans l'ordre chronologique.
@param $semestre: semestre pendant lequel se déroule le module
@param $ue: ue associé dans lequel se déroule le module
@param $nom: nom en français des modules.
@param $coeff: coefficient du module
@param $cm,$td,$tp,$tpe: nombre d'heure respectivement de CM,TD,TP et TPE dans ce module
@param $credits: credits de l'ue associée au module

@return le code html correspondant à ce tableau
*/

function tab_matieres($semestre,$ue,$nom,$coeff,$cm,$td,$tp,$tpe,$credits){
	$Tcm=0;
	$Ttd=0;
	$Ttp=0;
	$Ttpe=0;
	$Tcred=0;
	$i=0;
	$resu=tab_entete();
	while ($i<count($semestre)){
		$Scm=0;
		$Std=0;
		$Stp=0;
		$Stpe=0;
		$u=$ue[0];
		$sem=$semestre[$i];
		$corps_sem="";
		while ($i<count($semestre) && $sem==$semestre[$i]){
			$Ucm=0;
			$Utd=0;
			$Utp=0;
			$Utpe=0;
			$u=$ue[$i];
			$tab_modules="";
			while($i<count($semestre) && strcmp($u,$ue[$i])==0){
				$tab_modules.=tab_module($nom[$i],$cm[$i],$td[$i],$tp[$i],$tpe[$i],$coeff[$i]);
				$Ucm+=$cm[$i];
				$Utd+=$td[$i];
				$Utp+=$tp[$i];
				$Utpe+=$tpe[$i];
				$i++;
			}
			$entete_ue=tab_ue($ue[$i-1],$Ucm,$Utd,$Utp,$Utpe,$Ucm+$Utd+$Utp+$Utpe,$credits[$i-1]);
			$corps_ue=$tab_modules;
			$contenu_ue=$entete_ue.$corps_ue;
			$corps_sem.=$contenu_ue;
			$Scm+=$Ucm;
			$Std+=$Utd;
			$Stp+=$Utp;
			$Stpe+=$Utpe;
		}
		$entete_sem=tab_semestre($semestre[$i-1],$Scm,$Std,$Stp,$Stpe,$Scm+$Std+$Stp+$Stpe);
		$contenu_sem=$entete_sem.$corps_sem;
		$resu.=$contenu_sem;
		$Tcm+=$Scm;
		$Ttd+=$Std;
		$Ttp+=$Stp;
		$Ttpe+=$Stpe;
		$Tcred+=30;

	}
	return $resu.tab_fin($Tcm,$Ttd,$Ttp,$Ttpe,$Tcm+$Ttd+$Ttp+$Ttpe,$Tcred);
}

//===========================================
//	Fontion tableaux de l'quipe ensaignante
//===========================================

/*Génération du tableau de l'équipe pédagogique comme il est présent page 4 du livret

@param $prenoms: listes des prénoms des menbres de l'équipe pédagogique
@param $noms: listes des noms des menbres de l'équipe pédagogique
@param $specialites: listes des specialités des menbres de l'équipe pédagogique
@param $fonctions: listes des fonctions des menbres de l'équipe pédagogique

@return un code html correspondant à ce tableau
*/

function tab_enseignants($prenoms,$noms,$specialites,$fonctions){
	$contenu='<link rel="stylesheet" href="tab_matieres.css" type="text/css">';
	$contenu.='<table class="tab_enseignants">';
	$contenu.=<<<tab
	<tr>
		<th width="5%"> </th>
		<th width="15%"> Nom </th>
		<th width="15%"> Prénom </th>
		<th width="25%"> Spécialité </th>
		<th width="40%"> Fonction/Responsabilité </th>
	</tr>
tab;
	for ($i=0;$i<count($prenoms);$i++){
		$j=$i+1;
		$contenu.=<<<tab
		<tr>
			<td> $j</td>
			<td> $prenoms[$i]</td>
			<td> $noms[$i]</td>
			<td> $specialites[$i]</td>
			<td> $fonctions[$i]</td>
		</tr>
tab;
	}
	$contenu.="</table>";
	return $contenu;
}

//================================
//	Tableau détails des matières
//================================

function tab_details_module($nom,$code,$formation,$coeff,$cm,$td,$tp,$tpe,$obj,$prerequis,$contenu,$eval){
	$resu='<p><font size="+3" color="green" face="Times">';
	$resu.="$formation $code: $nom</font></p>";
	$resu.='<br/><br/><table border="1">';
	$resu.=<<<Tab
	<tr>
		<td><b> Coefficient:</b> $coeff</td>
		<td><b> CM:</b> $cm H</td>
		<td><b> TD:</b> $td H</td>
		<td><b> TP:</b> $tp H</td>
		<td><b> TPE:</b> $tpe H</td>
	</tr>
Tab;
	$resu.='<tr><td colspan="5">';
	$resu.=$obj."</td></tr>";
	$resu.='<tr><td colspan="5"><b>'
	$resu.=$prerequis."</td></tr>";
	$resu.='<tr><td colspan="5"><b>'
	$resu.=$contenu."</td></tr>";
	$resu.='<tr><td COLSPAN="5">';
	$resu.=$evaluation;
	$resu.="</table>";
	return $resu;
	}

function tab_details_ue($ue,$code,$formation,$cm,$td,$tp,$tpe,$credit){
	$vht=$cm+$tp+$td+$tpe;
	$resu='<br/><br/><table border="1">
	<tr>
		<td colspan="6" style="background-color: #5EB54D;"><font size="+4" face="Times">';
	$resu.="$formation $code: $ue</font></td>
	</tr>
	<tr>
		<td><b>CM:</b> $cm</td>
		<td><b>TD:</b> $td</td>
		<td><b>TP:</b> $tp</td>
		<td><b>TPE:</b> $tpe</td>
		<td><b>VHT:</b> $vht</td>
		<td><b>Crédits:</b> $credit</td>
	</tr>
	</table>";
	return $resu;
}

function tab_details_semestre($num,$cm,$td,$tp,$tpe){
	$vht=$cm+$tp+$td+$tpe;
	$resu='<br/><br/><table border="1">
	<tr>
		<td colspan="6" style="background-color: #109DEC;"><font size="+4" face="Times">';
	$resu.="SEMESTRE $num</font></td>
	</tr>
	<tr>
		<td><b>CM:</b> $cm</td>
		<td><b>TD:</b> $td</td>
		<td><b>TP:</b> $tp</td>
		<td><b>TPE:</b> $tpe</td>
		<td><b>VHT:</b> $vht</td>
		<td><b>Crédits:</b> 30</td>
	</tr>
	</table>";
	return $resu;
}

/*Génération de tableaux de details des modules, comme à partir de la page 16 jusqu'à la page 32.

@param Les arguments sont des tableaux(sauf formation) avec les modules regroupés par l'ue à laquelle ils appartiennent et par semestre dans l'ordre chronologique.
@param $formation: nom de la formation concernée
@param $semestre: semestre pendant lequel se déroule le module
@param $ue: ue associé dans lequel se déroule le module
@param $nom: nom en français des modules.
@param $code: code associé au module
@param $formation: associée au module
@param $coeff: coefficient du module
@param $cm,$td,$tp,$tpe: nombre d'heure respectivement de CM,TD,TP et TPE dans ce module
@param $prerequis: tableau des prérequis pour suivre le module
@param $contenu: tableau des contenus du module
@param $eval: 4 pourcentage qui représente la part de CC et de DS dans l'évaluation, et la part de TP et de Contrôle dans l'évaluation du CC

@return le code html correspondant aux tableaux
*/

function tab_details_matière($semestre,$ue,$nom,$code,$formation,$coeff,$cm,$td,$tp,$tpe,$obj,$prerequis,$contenu,$eval,$credits){
	$i=0;
	$resu="";
	while ($i<count($semestre)){
		$Scm=0;
		$Std=0;
		$Stp=0;
		$Stpe=0;
		$u=$ue[0];
		$sem=$semestre[$i];
		$corps_sem="";
		while ($i<count($semestre) && $sem==$semestre[$i]){
			$Ucm=0;
			$Utd=0;
			$Utp=0;
			$Utpe=0;
			$u=$ue[$i];
			$tab_modules="";
			while($i<count($semestre) && strcmp($u,$ue[$i])==0){
				$tab_modules.=tab_details_module($nom[$i],$code[$i],$formation,$coeff[$i],$cm[$i],$td[$i],$tp[$i],$tpe[$i],$obj[$i],$prerequis[$i],$contenu[$i],$eval[$i]);
				$Ucm+=$cm[$i];
				$Utd+=$td[$i];
				$Utp+=$tp[$i];
				$Utpe+=$tpe[$i];
				$i++;
			}
			$entete_ue=tab_details_ue($ue[$i-1],floor($code[$i-1]/10),$formation,$Ucm,$Utd,$Utp,$Utpe,$credits[$i-1]);
			$corps_ue=$tab_modules;
			$contenu_ue=$entete_ue.$corps_ue;
			$corps_sem.=$contenu_ue;
			$Scm+=$Ucm;
			$Std+=$Utd;
			$Stp+=$Utp;
			$Stpe+=$Utpe;
		}
		$entete_sem=tab_details_semestre($semestre[$i-1],$Scm,$Std,$Stp,$Stpe);
		$contenu_sem=$entete_sem.$corps_sem;
		$resu.=$contenu_sem;
	}
	return $resu;
}
?>
