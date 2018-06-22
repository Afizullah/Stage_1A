<?php
require_once(PATH_CONTROLEUR."admin/initFormation.file.class.php");
require_once(PATH_CONTROLEUR."admin/initFormation.projet.class.php");
class InitFormation{
	public $data =null;
	public function __construct(){
		//if(isset($_REQUEST["initWhite"])){
		//	$initWhith = secure($_REQUEST["initWhite"]);
		$this->data = new InitFormationWithFile();
		/*
			switch ($initWhith) {
				case 'file':
					$this->data = new InitFormationWithFile();
					break;
				case 'projet':
					$this->data = new InitFormationWithProjet();
					break;
				default:
					break;

			}
	//	} */
	}
	public function getData(){
		return $this->data;
	}
}


?>
