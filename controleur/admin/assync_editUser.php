<?php
require_once(PATH_CONTROLEUR."commun.user.php");
require_once(PATH_CONTROLEUR."commun.func.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require PATH_PHP_MAILLER . "src/Exception.php";
require PATH_PHP_MAILLER . "src/PHPMailer.php";
require PATH_PHP_MAILLER . "/src/SMTP.php";

function test($token,$user_id){
	$user_token=editUser::get_token($user_id);
	$token_tab=explode("<>",$user_token);
	if (strcmp($token_tab[0],$token)==0){
		return $token_tab[1];
	}
	return "";
}

$user_id=CurrentUser::getId();
if (isset($_POST['token'])){
	if ($email=test(secure($_POST["token"]),$user_id)){
		editUser::update_email($email,$user_id);
		$message='<p style="color:green; text-align:center;">Adresse email modifiée</p>';
		$tab="4";
	}
	else{
		$message='<p style="color:red; text-align:center;">Code invalide</p>';
		$tab="4";
	}
	editUser::delete_token($user_id);
}
else{
	$id=$_POST['label'];
	$current_mdp=editUser::get_current_mdp($user_id)[0]['user_mdpasse'];//to do
	$rep_current_mdp=$_POST['mdp'];
	if(strcmp(_hash($rep_current_mdp),$current_mdp)!=0){// test la validité du mot de passe
		$message='<p style="color:red; text-align:center;">Mot de passe invalide</p>';
		$tab="$id:TRUE:FALSE:FALSE";
	}
	else{
		if($id==1){//mdp
			if (!(strcmp($_POST['mdp2'],"")) || 
				!(strcmp($_POST['mdp3'],""))){
				$message='<p style="color:red; text-align:center;">Les mots de passe saisis sont invalides</p>';
				$tab="$id:FALSE:TRUE:TRUE";
			}
			else{
				if(strcmp($_POST['mdp2'],$_POST['mdp3'])!=0){
					$message='<p style="color:red; text-align:center;">Les mots de passe saisis sont différents</p>';
					$tab="$id:FALSE:TRUE:TRUE";
				}
				else{
					editUser::update_mdp(_hash(secure($_POST['mdp2'])),$user_id);
					$message='<p style="color:green; text-align:center;">Votre mot de passe a été modifié</p>';
					$tab="$id:TRUE:TRUE:TRUE";
				}
			}
		}
		else{//$id==2 email
			if (!(filter_var($_POST['mail1'], FILTER_VALIDATE_EMAIL)) || 
				!(filter_var($_POST['mail2'], FILTER_VALIDATE_EMAIL))){
				$message='<p style="color:red; text-align:center;">Les adresses email saisies sont invalides</p>';
				$tab="$id:FALSE:TRUE:TRUE";
			}
			else{
				if (strcmp($_POST['mail1'],$_POST['mail2'])!=0){
					$message='<p style="color:red; text-align:center;">Les adresses email saisies sont différentes</p>';
					$tab="$id:FALSE:FALSE:TRUE";
				}
				else{
					$token=getNewToken(5);
					$ObjectMail = new PHPMailer(true);
					if(sendMail2($ObjectMail,$_POST['mail1'],$token)){

						// A TRAITER editUser::update_email(secure($_POST['mail1']),$user_id);
						
						editUser::create_token($user_id,$token."<>".secure($_POST['mail1']));
						$message='<p style="text-align:center;"> Un code de confirmation vous a été envoyé à l adresse '.$_POST['mail1'].'</p>';
						$tab="3";
					}
					else{
						$message='<p style="color:red; text-align:center;">Erreur validation</p>';
						$tab="$id:TRUE:TRUE:TRUE";
					}
				}	
			}
		}
	}
}
//niakhdaouda@gmail.com