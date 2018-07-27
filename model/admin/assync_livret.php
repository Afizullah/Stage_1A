<?php
function publier_livret($filename){
	$filelocation = "/var/www/html/livret/model/livret-pdf/";
	$filecible=$filelocation."livret-pub/";
	$resu=copy($filelocation.$filename.".pdf",$filecible.$filename.".pdf");
	$resu=$resu && copy($filelocation.$filename.".png",$filecible.$filename.".png");
	return $resu;	
}
?>