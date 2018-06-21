<?php
require_once(DB_OPT_FILE);
class Projet extends DB{
    public static function getCurrentProjet(){
        if(isset($_SESSION["loaderProjet"])){
            return array("name"=>$_SESSION["loaderProjet"]["projet_nom"],"step"=>$_SESSION["loaderProjet"]["projet_step"],"state"=>$_SESSION["loaderProjet"]["projet_etat"]);
        }else{
            if($idProjetToLoad = DB::getLine("_paramettres","param_value",[["param_name","idLastProjetLoaded"]])["param_value"]){
               if($currentPojet = DB::getLine("projet","*",[["projet_id",$idProjetToLoad]])){
                   $name = $_SESSION["loaderProjet"]["projet_nom"] = $currentPojet["projet_nom"];
                   $step = $_SESSION["loaderProjet"]["projet_step"] = $currentPojet["projet_step"];
                   $stat = $_SESSION["loaderProjet"]["projet_etat"] = $currentPojet["projet_etat"];
                   return array(
                       "name"=>$name,
                       "step"=>$step,
                       "stat"=>$stat
                   );
                }
             }
              return false;
           }
        }
        public static function createProject($nom){
            return DB::registre("projet",[["projet_nom",$nom]]);
        }
        public static function setLoadedProjet($idLoadedProjet){
            DB::update("_paramettres",[["param_value",$idLoadedProjet]],[["param_name","idLastProjetLoaded"]]);
            selft::getCurrentProjet();
        }
}

?>
