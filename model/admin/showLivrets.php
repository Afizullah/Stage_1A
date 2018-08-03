<?php

class showLivrets extends DB{
	public static function getLivrets($projet_id){
		return DB::query("SELECT livret_nom FROM livret WHERE projet_id=".intval($projet_id));
	}
	public static function getName($projet_id){
		return DB::query("SELECT projet_nom FROM projet WHERE projet_id=".intval($projet_id));
	}

	public static function FormationDepublie($formations,$projet_id){
		for($i=0;$i<count($formations);$i++){
			DB::update("formation",[["formation_etat","non_publie"]],[["formation_code",$formations[$i]],["projet_id",$projet_id]]);
		}
	}

	public static function deleteLivret($filename,$projet_id){
		$filelocation=PATH_MODEL."livret-pdf/".$projet_id."/";
		if((!unlink($filelocation.$filename.".pdf"))||(!unlink($filelocation.$filename.".png"))){
			return false;
		}
		@rmdir($filelocation);
		DB::execute("DELETE FROM livret WHERE projet_id=".$projet_id." AND livret_nom="."'".$filename."'");
		return true;
	}
}

function get_projet_id($filelocation){
	$iterator = new DirectoryIterator($filelocation);
	$resu=array();

    foreach($iterator as $dir){
    	if ($dir->isDir()){
    		if ($dir->getFilename()[0]!="."){
            	$resu[]=$dir->getFilename();
            }
    	}
    }
    return $resu;
}
	


?>

 