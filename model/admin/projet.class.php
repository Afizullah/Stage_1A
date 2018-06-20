<?php
require_once(DB_OPT_FILE);
class Projet extends DB{
    public static function getCurrentProjet(){
        if(isset($_SESSION["loaderProjet"])){
            return array("name"=>$_SESSION["loaderProjet"]["projet_nom"],"step"=>$_SESSION["loaderProjet"]["projet_step"],"state"=>$_SESSION["loaderProjet"]["projet_etat"]);
        }else{
            if($idProjetToLoad = DB::getLine("paramettres","param_value",[["param_name","idLastProjetLoaded"]])["param_value"]){
               // if($currentPojet = DB::getLine(""))
            }
        }
    }

}

?>
