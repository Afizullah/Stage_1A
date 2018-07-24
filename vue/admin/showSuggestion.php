<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<center><b>ERROR</b>::Accès non autorisé</center>");
        }
    }else{
        header("Location:../");
        die("<center><b>ERROR</b>::Accès non autorisé</center>");
    }
?>
<div style="background-color:white;min-height:450px" class="col-lg-12"> <?php
    if(isset($suggestions) && $suggestions){
        echo center($titleSuggestion);
        if($suggestionId=="all"){
            foreach ($suggestions as $suggestionKey => $suggestions_fields) {  ?>
                <a href="index.php?page=showSuggestion&suggesId=<?php echo $suggestions_fields['suggestion_id']; ?>">
                    <div style="background-color:#e0ebec9c;margin-bottom:3px" class="col-md-12">
                        <div title="<?php echo $suggestions_fields['user_prenom']." ".$suggestions_fields['user_nom'].' - '.$notifValue['user_mail']; ?>" class="col-md-2">
                            <center>
                                <i style="padding:10px;background-color:white" class="img-circle icon fa fa-2x fa-user"></i>
                            </center>
                        </div>
                        <div class="col-md-10 sl-content">
                            <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                            <?php echo str_replace("_"," ",$suggestions_fields['suggestion_cible']); ?></span>
                            <div class="clearfix"></div>
                            <p class="truncate"><?php echo $suggestions_fields["suggestion_valeur"]; ?></p>
                        </div>
                    </div>
                </a>
                <hr class="light-grey-hr ma-0"/>
                <?php
            }
        }else{
            foreach ($suggestions as $suggestionKey => $suggestions_fields) {  ?>
                <div  style="border:1px solid rgba(200,200,200,0.5);margin-bottom:10px" class="col-md-12">
                    <div style="color:blue" class="col-md-12 title">
                        <u style="font-size:15px"> <?php 
                            echo center("<b title='".$suggestions_fields['user_mail']."' >".$suggestions_fields['user_prenom']." ".$suggestions_fields['user_nom']."</b> à fait une suggestion sur ".str_replace("_"," ",$suggestions_fields['suggestion_cible'])); ?>
                        </u>
                    </div>
                    <div style="text-align:justify" class="col-md-12 lead"> <?php
                        echo $suggestions_fields['suggestion_valeur']; ?>
                    </div>
                </div> <?php
            }
        }
    }else{
        echo center("Aucune sugestion");
    } ?>
</div>
