<?php
require_once(PATH_MODEL."admin/projet.class.php");

function testdoublons($post){
    $tab=array();
    for ($i=0;$i<count($post);$i++){
        $id=explode(";",($_POST["link2"][$i]));
        if (count($id)==2){
            $tab[]=$id[1];
        }
    }
    return (count($tab)!=count(array_unique($tab)));    
}

$html="";
$projet_id=$PROJET->getId();
function add_respo($formation_id,$user_id){
    global $projet_id;
    //cas ou l'utilisateur est déjà respo
    if($tab=ShowUsers::est_respo($user_id,$projet_id)){
        ShowUsers::delete_respo($tab[0]['formation_id'],$user_id);
    }
    //cas ou la formation a déjà un respo
    if($us_id=ShowUsers::current_respo($formation_id)[0]['user_id']){
        ShowUsers::delete_respo($formation_id,$us_id);
    }
    ShowUsers::create_respo($formation_id,$user_id);
}


if (isset($_POST["editGroupeListe"])) {
    if (isset($_POST['link'])) {
        $groupes = $PROJET->getGroupes();
        foreach ($groupes as $groupe => $v) {
            $grId = $v["groupe_id"];
            ShowUsers::deleteGroup($grId);
        }
        for ($i = 0; $i < count($_POST["link"]); $i++) {
            $id = explode(";", ($_POST["link"][$i]));
            if (count($id) == 2) {
                $userId = (int)$id[0];
                $groupId = (int)$id[1];

                ShowUsers::registerGroup($userId, $groupId);
            }
        }
    }
    if (isset($_POST['link2'])){
        if (testdoublons($_POST['link2'])){
            $html="<p style='color:red'>Vos modifications n'ont pas été prises en compte (un seul responsable pédagogique par formation)</p>";
        }
        else{
            for ($i=0;$i<count($_POST["link2"]);$i++){
                $id=explode(";",($_POST["link2"][$i]));
                if (count($id)==2){
                    $user_id=(int)$id[0];
                    $formation_id=(int)$id[1];
                    add_respo($formation_id,$user_id);
                }
            }
            $html="<p style='color:green'>Vos modifications ont bien été prises en compte</p>";
        }
        
    }
}

?>
