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
<div class="container-fluid">
<div class="modal fade" id="addEcGroupe" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Sélectionner un ec</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <?php for($i=0; $i<count($ecWithoutGroup); $i++) { ?>
                <input type="checkbox" name="ecId[]" value="<?php echo ($ecWithoutGroup[$i]["ec_id"]); ?>" id="subject<?php echo ($ecWithoutGroup[$i]["ec_id"]); ?>" ><label for="subject<?php echo ($ecWithoutGroup[$i]["ec_id"]); ?>"> <?php print_r($ecWithoutGroup[$i]['ec_nom']); ?></label> </br></br>
            <?php } ?>
            <input type="hidden" name="groupId" value="<?php echo($groupId); ?>">
            <div style="text-align: center;">
                <input class="btn btn-success" type="submit" value="Affecter" name="affecter">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteSubject" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Sélectionner un ec</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
      <?php $PROJET=new Projet; ?>
        <form action="" method="POST">
                <?php for ($i=0; $i<count($ecWithoutGroup); $i++) {?>
                    <input type="checkbox" id="subject" name="subject"><label for="subject"><?php print_r($participantsWithoutGroup[$i]['user_prenom']." ".$participantsWithoutGroup[$i]['user_nom']); ?></label> </br></br>
                    <input type="hidden" name="userId[]" value="">
                <?php } ?>
                <input type="hidden" name="groupId" value="<?php echo($groupId); ?>">
                <div>
                    
                </div>
            <div style="text-align: center;">
                <input class="btn btn-danger" type="submit" value="Supprimer" name="affecter">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="suggestionNom" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Sélectionner un nom</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
      <?php $PROJET=new Projet; ?>
        <form action="" method="POST">
        <input type="hidden" name="ecIdSug" id="ecIdSug" value="">
            <div id="contentOptionsSuggesName"></div>
            <div>
                <textarea name="contentSuggesName" id="contentSuggesName" cols="60" rows="10">
                </textarea>
            </div>
            <div style="text-align: center;">
                <input class="btn btn-success" type="submit" value="Appliquer" name="appliquerNom">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="suggestionCompetence" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Sélectionner une compétence</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
      <?php $PROJET=new Projet; ?>
        <form action="" method="POST">
                <?php for ($i=0; $i<count($suggestions); $i++) {
                    if($suggestions[$i]['suggestion_cible']!=='ec_competence') continue;    
                ?>
                    <input type="radio" id="suggestionCompet" name="suggestionCompet" value="<?php echo($suggestions[$i]['suggestion_valeur']); ?>"><label for="subject"><?php print_r($suggestions[$i]['suggestion_valeur']); ?></label> </br></br>
                    <input type="hidden" name="userId[]" value="">
                <?php } ?>
                <input type="hidden" name="groupId" value="<?php echo($groupId); ?>">
                <div>
                <textarea name="contentSuggesCompetence" id="contentSuggesCompetence" cols="60" rows="10">
                </textarea>
                </div>
            <div style="text-align: center;">
                <input class="btn btn-success" type="submit" value="Appliquer" name="appliquerCompet">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="suggestionPrerequis" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Sélectionner un prérequis</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
      <?php $PROJET=new Projet; ?>
        <form action="" method="POST">
                <?php for ($i=0; $i<count($suggestions); $i++) {
                    if($suggestions[$i]['suggestion_cible']!='ec_prerequis') continue;
                ?>
                    <input type="radio" id="suggestionPrerequis" name="suggestionPrerequis" value="<?php echo($suggestions[$i]['suggestion_valeur']); ?>"><label for="subject"><?php print_r($suggestions[$i]['suggestion_valeur']); ?></label> </br></br>
                    <input type="hidden" name="userId[]" value="">
                <?php } ?>
                <input type="hidden" name="groupId" value="<?php echo($groupId); ?>">
                <div>
                    <textarea name="contentSuggesPrerequis" id="contentSuggesPrerequis" cols="60" rows="10">
                    </textarea>
                </div>
            <div style="text-align: center;">
                <input class="btn btn-success" type="submit" value="Appliquer" name="appliquerPrerequis">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<!-- Title -->
    <a class="btn btn-success" data-toggle="modal" href="#addEcGroupe">
        Affecter un ec
    </a>
    <a class="btn btn-danger" data-toggle="modal" href="#deleteSubject">
        Supprimer un ec
    </a>
<div class="row heading-bg">
    
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h5 class="txt-dark">Liste des matières</h5>
    </div>
    <!-- Breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li><a href="index.html">Dashboard</a></li>
        <li><a href="#"><span>table</span></a></li>
        <li class="active"><span>data-table</span></li>
      </ol>
    </div>
    <!-- /Breadcrumb -->
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Liste des matières</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom</th>
                                        <th>Compétence</th>
                                        <th>Prérequis</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php for ($i=0; $i<count($ecInGroup); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php print_r($ecInGroup[$i]['ec_code']); ?></td>
                                        <td>
                                            <a onclick="suggestionNom(this);" alt="<?php echo($ecInGroup[$i]['ec_id']); ?>" class="" data-toggle="modal" href="#suggestionNom">
                                            <?php print_r($ecInGroup[$i]['ec_nom']); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="suggestionCompetence(this);" alt="<?php echo($ecInGroup[$i]['ec_id']); ?>" class="" data-toggle="modal" href="#suggestionCompetence">
                                            <?php print_r($ecInGroup[$i]['ec_competence']); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="suggestionPrerequis(this);" alt="<?php echo($ecInGroup[$i]['ec_id']); ?>" class="" data-toggle="modal" href="#suggestionPrerequis">
                                            <?php print_r($ecInGroup[$i]['ec_prerequis']); ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</div>
<!-- /Row -->

<!-- /Row -->
</div>
<script src="<?php echo PATH_TEMPLATE; ?>dist/js/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_TEMPLATE; ?>dist/js/dataTables-data.js"></script>
<script>

    function loadOptions(ecId,attrib,notifIn){
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(notifIn).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "index.php?page=assync.loadOptions&ecId=" + ecId +"&attrib="+attrib, true);
        xmlhttp.send();

    }
    
    function suggestionNom(element) {
        document.getElementById("ecIdSug").value = element.getAttribute("alt");
        document.getElementById("contentSuggesName").value = element.innerHTML;
        var ecId = document.getElementById("ecIdSug").value;
        loadOptions(ecId,"ec_nom","contentOptionsSuggesName");
    }

    function suggestionCompetence(element) {
        document.getElementById("ecIdSug").value = element.getAttribute("alt");
        document.getElementById("contentSuggesCompetence").value = element.innerHTML;
    }

    function suggestionPrerequis(element) {
        document.getElementById("ecIdSug").value = element.getAttribute("alt");
        document.getElementById("contentSuggesPrerequis").value = element.innerHTML;
    }

</script>