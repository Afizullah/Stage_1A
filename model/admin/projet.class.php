<?php
require_once(DB_OPT_FILE);
require_once(PATH_MODEL."admin/assync.loadSuggest.php");
class Projet extends DB{
    private $name="";
    private $id=0;
    private $step=0;
    private $state="";
    private $projets=null;
    private $formations=null;
    private $groupes=null;
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
        $this->projets = parent::getData("projet","*",[[1,1]],array()," ORDER BY projet_date_creation DESC ");
        $this->formations = parent::getData("formation","*",[["projet_id",self::getId()]]);
        $this->groupes = parent::getData("groupe","*",[["projet_id",self::getId()]]);
    }
    public static function createProject($nom){
        if($projetId = parent::registre("projet",[["projet_nom",$nom]])){
            self::setLoadedProjet($projetId);
            $invariants = ["SIGLES ET ABRÉVIATIONS","EQUIPE PEDAGOGIQUE","MOT DU CHEF DE DEPARTEMENT","EXTRAIT DU REGLEMENT INTERIEUR DE L’ESP","LA PRESENTATION DES FORMATIONS"];
            for ($i=0; $i < count($invariants); $i++) {
                if($invariantId = parent::registre("invariant",[["invariant_nom",$invariants[$i]]])){
                    parent::registre("projet_invariant",[["projet_id",$projetId],["invariant_id",$invariantId]]);
                }
            }
        }
        return $projetId;
    }
    public static function setLoadedProjet($idLoadedProjet){
        parent::update("_paramettres",[["param_value",$idLoadedProjet]],[["param_name","idLastProjetLoaded"]]);
    }
    public function getName(){
        return $this->name;
    }
    public function setName($newName){
        if(parent::update("projet",[["projet_nom",$newName]],[["projet_id",$this->getId()]])){
            $_SESSION["loaderProjet"]["projet_nom"] = $newName;
            $this->name = $newName;
            return true;
        }
        return false;
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
    public function getAll(){
        if($this->projets){
            return $this->projets;
        }
        return parent::getData("projet","*",[[1,1]],array()," ORDER BY projet_date_creation DESC ");
    }
    public function getFormations(){
        if($this->formations){
            return $this->formations;
        }
        return parent::getData("formation","*",[["projet_id",self::getId()]]);
    }
    public function getNotifications(){
        return Sugges::getNotRead(self::getId());
    }
    public function getFormationsNames(){
        $formsNames = array();
        if($formations=self::getFormations()){
            foreach ($formations as $keyFormation => $valsForm) {
                    $formsNames[]=$valsForm["formation_nom"];
            }
            return $formsNames;
        }else{
            return false;
        }

    }
    public function getTabFormationsId(){
        $formations = self::getFormations();
        $tabIdFormation = array();
        for ($i=0; $i < count($formations); $i++) {
            $tabIdFormation[]=$formations[$i]["formation_id"];
        }
        return $tabIdFormation;
    }
    public function getGroupes(){
        if($this->groupes){
            return $this->groupes;
        }
        return parent::getData("groupe","*",[["projet_id",self::getId()]]);
    }
    public function getGroupeForUser($userId,$groupeId){
        return parent::getLine("groupe_utilisateurs","*",[["user_id",$userId],["groupe_id",$groupeId]]);
    }
    public function getAllOtherProjets($thisIdProject){
        return parent::getData("projet","*",[["projet_id",intval($thisIdProject)]],["!="]);
    }
    public function getUsersWithGroupe(){
        $teacherWhithGroupe = array();
        if($results = parent::getData("groupe NATURAL JOIN groupe_utilisateurs NATURAL JOIN utilisateurs NATURAL JOIN compte","user_id",[["projet_id",intval(self::getId())],["compte_typeCompte","enseignant"]])){
            foreach ($results as $resultKey => $resultFields) {
                $teacherWhithGroupe[]=intval($resultFields["user_id"]);
            }

        }
        return $teacherWhithGroupe;
    }
    private function getAllTeather(){
        $teacherListe = array();
        if($results = parent::getData("utilisateurs NATURAL JOIN compte","user_id,user_mail",[["compte_typeCompte","enseignant"]])){
            foreach ($results as $resultKey => $resultFields) {
                $teacherListe[]=$resultFields;
            }
        }
        return $teacherListe;
    }
    public function getUserWithoutGroupe(){
        $userWithoutGroupe = array();
        if($teachersWithoutGroupe = self::getAllTeather()){
            $usersWitheGroupe = self::getUsersWithGroupe();
            foreach ($teachersWithoutGroupe as $teachersWithoutGroupekey => $teachersWithoutGroupeFields) {
                if(!in_array($teachersWithoutGroupeFields["user_id"],$usersWitheGroupe)){
                    $userWithoutGroupe[] = $teachersWithoutGroupeFields;
                }
            }
        }
        return $userWithoutGroupe;
    }
}
    $PROJET = new Projet;
?>
