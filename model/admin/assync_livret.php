<?php

class publ_livret extends DB{

	public static function publier_livret($filename,$projet_id,$formations){
		//ajout dans le dossier des livrets publiés
		$filelocation = getAbsolutePathOutputLivret();
		$filecible=$filelocation.$projet_id."/";
		// créer le dossier correspondant au projet si il n'existe pas
		if(!is_dir($filecible)){
   			mkdir($filecible);
   			chmod($filecible, 0777);
		}
		//copie le pdf et sa vignette 
		$resu=copy($filelocation.$filename.".pdf",$filecible.$filename.".pdf");
		$resu=$resu && copy($filelocation.$filename.".png",$filecible.$filename.".png");
		chmod($filecible.$filename.".pdf",0777);
		chmod($filecible.$filename.".png",0777);
		//ajout dans la base de données livret
		$date=date("Y-m-d G:i:s");
		if (!(DB::registre("livret",[["livret_nom",$filename],["projet_id",$projet_id],["livret_etat","publié"],["livret_date_creation",$date]]))){
			$resu="";
		}
		//change le statut des formations publiées
		for ($i=0;$i<count($formations);$i++){
			DB::update("formation",[["formation_etat","publie"]],[["formation_id",$formations[$i]]]);
		}
		return $resu;	
	}
}	
?>