<?php
require_once(DB_OPT_FILE);
class Projet extends DB{
    private $name="";
    private $id=0;
    private $step=0;
    private $state="";
    public function __construct(){
        if(isset($_SESSION["loaderProjet"]) &&
            $_SESSION["loaderProjet"]["projet_id"]==parent::getLine("_paramettres","param_value",[["param_name","idLastProjetLoaded"]])["param_value"]){
            $this->id   = $_SESSION["loaderProjet"]["projet_id"];
            $this->name  = $_SESSION["loaderProjet"]["projet_nom"];
            $this->step  = $_SESSION["loaderProjet"]["projet_step"];
            $this->state = $_SESSION["loaderProjet"]["projet_etat"];

        }else{
            if($idProjetToLoad = parent::getLine("_paramettres","param_value",[["param_name","idLastProjetLoaded"]])["param_value"]){
               if($currentPojet = parent::getLine("projet","*",[["projet_id",$idProjetToLoad]])){
                   $this->id   = $_SESSION["loaderProjet"]["projet_id"]   = $currentPojet["projet_id"];
                   $this->name = $_SESSION["loaderProjet"]["projet_nom"]  = $currentPojet["projet_nom"];
                   $this->step = $_SESSION["loaderProjet"]["projet_step"] = $currentPojet["projet_step"];
                   $this->stat = $_SESSION["loaderProjet"]["projet_etat"] = $currentPojet["projet_etat"];


                }

             }

          }
    }
    public static function createProject($nom){
        if($projetId =  parent::registre("projet",[["projet_nom",$nom]])){
            self::setLoadedProjet($projetId);
        }
        return $projetId;
    }
    public static function setLoadedProjet($idLoadedProjet){
        parent::update("_paramettres",[["param_value",$idLoadedProjet]],[["param_name","idLastProjetLoaded"]]);
    }
    public function getName(){
        return $this->name;
    }
    public function getId(){
        return $this->id;
    }
    public function projetLoaded(){
        return $this->id;
    }
    public function getStep(){
        return $this->step;
    }
    public function getStat(){
        return $this->stat;
    }
    public static function getAll(){
        return parent::getData("projet","*",[[1,1]],array()," ORDER BY projet_date_creation DESC ");
    }
    public function getFormations(){
        return parent::getData("formation","*",[["projet_id",self::getId()]]);
    }
    public function getGroupes(){
        return parent::getData("groupe","*",[["projet_id",self::getId()]]);
    }
}

?>
