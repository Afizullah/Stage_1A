<?php
    function createSession($data){
       $_SESSION["livretSession"] = $data;
    }
    if(isset($_POST["login"],$_POST["mail"],$_POST["password"])){
        $email = secure($_POST["mail"]);
        $password = _hash($_POST["password"]);
        if(!isEmail($email)){
            $errors[]="Adresse email incorrect";
        }
        if(!isset($errors)){
            if($login =  Login::verify($email,$password)){
                createSession($login);
                header("Location:index.php?page=askAccountToConnect");
            }else{
                $errors[]="Email ou mot de passe incorrect";
            }
        }
    }

 ?>
