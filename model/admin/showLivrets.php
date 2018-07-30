<?php

function getLivrets($filelocation){
	$iterator = new DirectoryIterator($filelocation);
	$resu=array();

    foreach($iterator as $fichier){
    	$format=substr($fichier->getFilename(),-1);
    	if ($format=='f'){
            $resu[]=explode(".",$fichier->getFileName())[0];
    	}
    }
    return $resu;
} 
?>

 