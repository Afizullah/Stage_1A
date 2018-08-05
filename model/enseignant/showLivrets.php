<?php

class showLivrets extends DB{
	public static function getLivrets($projet_id){
		return DB::query("SELECT livret_nom FROM livret WHERE projet_id=".intval($projet_id));
	}
	public static function getName($projet_id){
		return DB::query("SELECT projet_nom FROM projet WHERE projet_id=".intval($projet_id));
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

 