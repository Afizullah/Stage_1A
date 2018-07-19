<?php
if(isset($suggestionListe) && $suggestionListe){
    foreach ($suggestionListe as $key => $value) {
        ?>
        <div  style="border:1px solid rgba(200,200,200,0.5);margin-bottom:10px" class="col-md-12">
            <div style="border:1px solid rgba(200,200,200,0.5);margin-left:-15px;padding-left:0px;padding-top:5px" class="col-md-3">
                <div title="<?php echo $value['user_mail']; ?>" style="text-align: center;">
                    <i style="border:1px solid black;;padding:10px;height:60px;border-radius:60px;width:60px" class="fa fa-3x fa-user"></i><br />
                    <?php
                    echo $value["user_prenom"]." ".$value["user_nom"];
                    ?><br />
                    <button class="btn btn-sm btn-success" type="button" name="button">Appliquer</button>
                    <button class="btn btn-sm btn-warning" type="button" name="button">Rejeter</button>
                    <br />
                </div>
            </div>
            <div   class="col-md-9">
                <?php
                echo $value["suggestion_valeur"];
                ?>
            </div>
        </div><br /><br /><br />
        <?php
    }
}else{
    echo center("Aucune suggestion pour cet élément n'est enregsitrée");
}

?>
