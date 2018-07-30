<?php

class publ_livret extends DB{

	public static function publier_livret($filename,$projet_id,$formations){
		//ajout dans le dossier des livrets publiés
		$filelocation = "/var/www/html/livret/model/livret-pdf/";
		$filecible=$filelocation."livret-pub/";
		$resu=copy($filelocation.$filename.".pdf",$filecible.$filename.".pdf");
		$resu=$resu && copy($filelocation.$filename.".png",$filecible.$filename.".png");
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