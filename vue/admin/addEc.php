<?php
	// If you need to parse XLS files, include php-excel-reader
	require('../spreadsheet-reader-master/php-excel-reader/excel_reader2.php');

	require('../spreadsheet-reader-master/SpreadsheetReader.php');

	// require_once('../commun/DB.class.php');

	// die('Salut');
	
	Class AddEc extends DB {
		public static function Ec() {
			// echo("Salut");
			// die();
			$Reader = new SpreadsheetReader('../spreadsheet-reader-master/Syllabus (2017-2018) - toutesFormations.xlsx');
			$i = 0;
			// Qui est déjà dans un projet mais n'appartient à aucun groupe

			foreach ($Reader as $Row) {
				// print_r($Row);
				if ($i == 1) {
					// echo("Salut");
					$ueId = 1;
					$groupeId = 1;
					$ecCode = $Row[2];
					$ecNom = $Row[6];
					$ecCompetence = $Row[7];
					$ecPrerequis = $Row[8];
					$ecContenu = $Row[9];
					$ecCoef = $Row[11];
					$ecNbreHCM = $Row[12];
					$ecNbreHTD = $Row[13];
					$ecNbreHTP = 15;
					$ecNbreHTPE = 10;
					print_r($Row);
				}
				$i++;
				if ($i == 2) break;
			}
	
			return DB::registre("ec",[["ue_id",$ueId],["ec_code",$ecCode],["ec_nom",$ecNom],["ec_competence",$ecCompetence],["ec_prerequis",$ecPrerequis],["ec_contenu",$ecContenu],["ec_coef",$ecCoef],["ec_nbre_heure_cm",$ecNbreHCM],["ec_nbre_heure_td",$ecNbreHTD],["ec_nbre_heure_tp",$ecNbreHTP],["ec_nbre_heure_tpe",$ecNbreHTPE]]);
		}
		
	}
	echo($PROJET->getId());
	AddEc::Ec();

?>

<!-- CREATE TABLE classe(
	classe_id int auto_increment not null,
	classe_nom varchar(30) default null,
	formation_id int not null,
	CONSTRAINT pk_Classe PRIMARY KEY (classe_id),
	CONSTRAINT fk_Classe_Formation FOREIGN KEY (formation_id) REFERENCES formation (formation_id)
); -->