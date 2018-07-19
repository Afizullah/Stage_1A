<?php
    if(isset($_GET["opt"],$_GET["suggestId"])){
        $opt = secure($_GET["opt"]);
        $suggesId = intval($_GET["suggestId"]);
        switch ($opt) {
            case 'apply':
            if(!$rep = Sugges::apply($suggesId)){
                    $errors[]="Echec lors de l'application de la suggestion";    
            }else{
                $res = $rep;
                $dataSugges["sugId"] = $res["suggestion_id"];
                $dataSugges["destId"] = _getHashName($res["suggestion_cible"])."_".$res["suggestion_cible_id"];
                $dataSugges["sugValue"] = $res["suggestion_valeur"]; 
            }
            break;
            case 'ignore':
                if(!Sugges::ignore($suggesId)){
                    $errors[]="La suggestion n'est pas ignorée";
                }
            break;
            default:
             $errors[]="Option non prise en compte";
            break;
        }
    } 
    $err=array();
    $dataSug = array();
    $status = 400;
    if(isset($errors)){
        $err = $errors;
    }else{
        $status = 200;
    }
    if(isset($dataSugges)){
        $dataSug = $dataSugges;
    }
    $err = json_encode($err);
    $dataSug = json_encode($dataSug);
?>