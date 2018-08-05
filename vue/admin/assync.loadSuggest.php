<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
        }
    }else{
        header("Location:../");
        die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
    }
?>
<?php
if(isset($suggestionListe) && $suggestionListe){
    foreach ($suggestionListe as $key => $value) {
        ?>
        <div id="<?php echo "sug_cont_".$value["suggestion_id"]; ?>" >
            <div style="border:1px solid rgba(200,200,200,0.5);margin-bottom:10px" class="col-md-12">
                <div style="border:1px solid rgba(200,200,200,0.5);margin-left:-15px;padding-left:0px;padding-top:5px" class="col-md-3">
                    <div title="<?php echo $value['user_mail']; ?>" style="text-align: center;">
                        <i style="border:1px solid black;;padding:10px;height:60px;border-radius:60px;width:60px" class="fa fa-3x fa-user"></i><br />
                        <?php
                        echo $value["user_prenom"]." ".$value["user_nom"];
                        ?><br />
                        <button class="btn btn-sm btn-success" onclick="applySuggestion(<?php echo $value["suggestion_id"]; ?>);" type="button" name="button">Appliquer</button>
                        <button class="btn btn-sm btn-warning" onclick="ignoreSuggestion(<?php echo $value["suggestion_id"]; ?>);" type="button" name="button">Ignorer</button>
                        <br />
                    </div>
                </div>
                <div   class="col-md-9">
                    <?php
                    echo $value["suggestion_valeur"];
                    ?>
                </div>
                
            </div><br /><br /><br />
        </div>
        <?php
    }
}else{
    echo center("Aucune suggestion pour cet élément n'est enregsitrée");
}

?>
