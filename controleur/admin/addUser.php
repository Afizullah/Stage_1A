<?php
//session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require PATH_PHP_MAILLER."src/Exception.php";
require PATH_PHP_MAILLER."src/PHPMailer.php";
require PATH_PHP_MAILLER."/src/SMTP.php";


    if(isset($_POST['addUser'])){
        if(isset($_POST['prenom'],$_POST['nom'],$_POST['mail'],$_POST['date_expiration'],$_POST['accountType'])){
            $allowedTypes = ["administrateur","enseignant","responsable_pedagogique"];
            $mail = secure($_POST['mail']);
            $prenom = secure($_POST['prenom']);
            $nom = secure($_POST['nom']);
            $date_expiration = secure($_POST['date_expiration']);
            $typeDeCompte = secure($_POST["accountType"]);

            if(!in_array($typeDeCompte,$allowedTypes)){
                $errors[]="Le type de compte est incorrect";
            }
            if(!isEmail($mail)) {
                $errors[]="Veuillez vérifier l'adresse mail saisie";
            }
            if(empty($prenom)){
                $errors[]="Le prenom ne doit pas être vide";
            }
            if(empty($nom)){
                $errors[]="Le nom ne doit pas être vide";
            }
            if(empty($date_expiration)){
                $errors[]="La date d'expiration ne doit pas être vide";
            }


            if(!isset($errors)){
                if(!User::verifUserExist($mail)){
                    do{
                        $token = getNewToken();
                    }while(User::verifToken($token));
                    $dateExpLink = getDateExpirationAccount(NBR_HOURS_LINK_EXP);
                    if(!User::addUserTemp($token,$prenom,$nom,$mail,$typeDeCompte,$date_expiration,$dateExpLink)){
                        $errors[]="Echec de l'enregistrement du compte";
                    }else{

                        $ObjectMail = new PHPMailer(true);
                        if(sendMail($ObjectMail,$mail,$prenom,$nom,$token)){
                            $success = "Compte créé avec succes !!!";
                        }else{
                            $errors[]="Echec de l'envoi du mèl de confirmation";
                        }
                    }
                }else{
                    $errors[]="Adresse email indiponible";
                }
            }
        }
    }

?>
