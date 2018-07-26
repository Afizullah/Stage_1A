<?php
define("PATH_TEMPLATE", "template/");
define("PATH_MODEL", "../model/");
define("PATH_VUE", "../vue/");
define("PATH_CONTROLEUR", "../controleur/");
//'initialiser','definir_specialites','classer_ec','definir_les_groupes','visionner_suggestions','definir_les_livrets'

define("PATH_ADMIN", "admin/");
define("PATH_ENSEIGNANT", "enseignant/");
define("PATH_RP", "responsable_pedagogique/");
define("PATH_IMG", PATH_TEMPLATE . "dist/img/");
define("PATH_LOGIN", "login/");
define("PATH_PHP_MAILLER", PATH_CONTROLEUR . "libs/SendMail/PHPMailer/");
define("PATH_PHPExcel", PATH_CONTROLEUR . "libs/PHPExcel/");
define("PHPExcel_CLASS_FILE", PATH_PHPExcel . "Classes/PHPExcel/IOFactory.php");

define("URL_LOGO", "https://www.senenews.com/wp-content/uploads/2016/04/ucadd-696x696.jpg");
define("ADMIN_LOGO", PATH_TEMPLATE . "dist/img/logo_admin.png");

define("DEFAULT_PAGE", "accueil");
define("NBR_HOURS_LINK_EXP", "48");
define("ASSYNC_FILES", ["regChange", "livret", "assync.SelectableFormations", "assync.loadFile", "assync.loadDb", "assync_suggestion", "assync.editProject", "assync.loadSuggest", "assync.loadOptions", "assync.changeSuggesStatus","assync_editUser"]);
define("MAP_PAGES", array(
    "accueil" => ["pageName" => "Accueil"],
    "addUser" => ["pageName" => "Créer un compte"],
    "showUsers" => ["pageName" => "Liste des utilisateurs"],
    "createProjet" => ["pageName" => "Créer un projet"],
    "showProjets" => ["pageName" => "Liste des projets"],
    "showFormations" => ["pageName" => "Liste des formations"],
    "exportFormation" => ["pageName" => "Exporter la formation"],
    "choixexportFormation" => ["pageName" =>  "Choix de la formation"],
    "aff_suggestion" => ["pageName" => "Liste des suggestions"],
    "groupes" => ["pageName" => "Liste des groupes"],
    "importFormation" => ["pageName" => "Importer une ou plusieurs formations"],
    "editFormation" => ["pageName" => "Modifier une formation"],
    "addGroupe" => ["pageName" => "Créer un nouveau groupe"],
    "genererLivret" => ["pageName" => "Générer un livret"],
    "editUser" => ["pageName" => "Modifier compte"]
));
define("SESS_ADMIN_CONTROLER",PATH_CONTROLEUR."admin/_controlSess.php");
?>
