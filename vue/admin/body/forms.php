<?php
function openPanel($parentId){
    ?>
    <div class="panel-group" id="<?php echo $parentId; ?>">
    <?php
}
function closePanel(){
    ?></div><?php
}
function insertPanel($parentId,$panelId,$title,$htmlContent){
    ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" style="display:block;text-align:center;" data-parent="#<?php echo $parentId; ?>" href="#<?php echo $panelId; ?>">
              <?php echo $title; ?>
          </a>
        </h4>
      </div>
      <div id="<?php echo $panelId; ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <?php echo $htmlContent; ?>
        </div>
      </div>
    </div>
    <?php
}
function getFormAddUsser($action="",$type_compte="",$date_expiration="",$email="",$prenom="",$nom=""){
    if($date_expiration){
        $_SESSION["dext"]=$date_expiration;
    } ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
            <span class="input-group-addon">Type de compte : </span>
            <select required class="form-control" name="accountType">
                <option value="">----Séléctionner----</option>
                <option <?php echo ($type_compte=="administrateur")?"selected":""; ?> value="administrateur">Administrateur</option>
                <option <?php echo ($type_compte=="responsable_pedagogique")?"selected":""; ?>  value="responsable_pedagogique">Responsable Pédagogique</option>
                <option <?php echo ($type_compte=="enseignant")?"selected":""; ?>  value="enseignant">Enseignant</option>
            </select>
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Date d'expiration : </span>
            <input required type="date" class="form-control" value="<?php if(isset($_SESSION["dext"])){echo $_SESSION["dext"]; } ?>" name="date_expiration" placeholder="">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Email : </span>
            <input required type="text" value="<?php echo $email; ?>" class="form-control" name="mail" placeholder="">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Prénom : </span>
            <input required type="text" value="<?php echo $prenom; ?>" class="form-control" name="prenom" placeholder="">
        </div><br />
        <div class="input-group">
              <span class="input-group-addon">Nom : </span>
              <input required type="text" value="<?php echo $nom; ?>" class="form-control" name="nom" placeholder="">
        </div><br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addUser" value="Créer un compte">
        </center>
    </form>
    <?php
}

function getFromCreateProjet($nomProjet="",$action=""){
    ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
              <span class="input-group-addon">Nom du projet : </span>
              <input required type="text" class="form-control" name="projet_nom" value="<?php echo $nomProjet; ?>" placeholder="Ex: Projet Livrets 2000">
        </div> <br/>
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addPojet" value="Créer un projet">
        </center>
    </form>

    <?php
}

function getFromCreateGroup($nomGroup="",$action=""){
    global $PROJET;
    ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">

        <div class="input-group">
              <span class="input-group-addon">Nom du groupe : </span>
              <input required type="text" class="form-control" name="groupe_nom" value="<?php echo $nomGroup; ?>" placeholder="Ex: Informatique">
        </div><br />
      <select class="basicSelect2" name="participants[]" multiple="multiple">
          <?php
          if($usersWithoutGroupe = $PROJET->getUserWithoutGroupe()){
              for ($i=0; $i <count($usersWithoutGroupe) ; $i++) {
                  ?>
                  <option value="<?php echo $usersWithoutGroupe[$i]["user_id"]; ?>"><?php echo  $usersWithoutGroupe[$i]["user_mail"]; ?></option>
                  <?php
              }

          }
          ?>
      </select><br /><br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addGroup" value="Créer un groupe">
        </center>
    </form>

    <?php
}


function getHiddenInput($name,$value){ ?>
    <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>"> <?php
}




function getFormEditEc($classId,$class,$ue,$ue_id){
    ?>
    <div class="modal fade" id="modalEcUe<?php echo $ue_id; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h5 style="float:left" class="modal-title" id=""><span style="color:red"><?php echo $class."</span> <i class='fa fa-angle-double-right'></i><span style='color:blue'> ".$ue; ?></span><span class="label label-success showInfosCreditUe<?php echo $ue_id; ?>"></span></h5>
                  <div id="notifChangedEc<?php echo $ue_id; ?>"></div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div style="max-height:500px;overflow-y:auto" class="modal-body">

              <?php
              if($ecs = Formation::getEcs($ue_id)){
                  foreach ($ecs as $ec => $ec_field) {
                      $ecId=$ec_field["ec_id"];
                      $codeEc = $ec_field["ec_code"];
                      $competence = $ec_field["ec_competence"];
                      $matiere = $ec_field["ec_nom"];
                      $prerequis = $ec_field["ec_prerequis"];
                      $contenu = $ec_field["ec_contenu"];
                      $coef = $ec_field["ec_coef"];
                      $nbrHeurCM = $ec_field["ec_nbre_heure_cm"];
                      $nbrHeurTD = $ec_field["ec_nbre_heure_td"];
                      $nbrHeurTP = $ec_field["ec_nbre_heure_tp"];
                      $nbrHeurTPE = $ec_field["ec_nbre_heure_tpe"];
                      ?>
                      <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a style="display:block" data-toggle="collapse" href="#collapseMatiere<?php echo $ecId; ?>">
                                    <?php $nomMatiere = ($matiere)?$matiere:"Matière non définie"; echo $nomMatiere; ?>
                                    <span id="infosCoef<?php echo $ecId;  ?>" class="label label-<?php echo ($coef==0)?"danger":"success"; ?>">
                                        Coef <span id="valInfoCoef<?php echo $ecId; ?>"><?php echo $coef; ?></span>
                                    </span>
                                </a>
                                <a style="float:right;margin-top:-20px" href="#deleteElement"  data-dismiss="modal" data-toggle="modal" onclick="openFormDropElement('ec','<?php echo $ecId; ?>','<?php echo $nomMatiere; ?>','<?php echo _hashName('ec'); ?>');" title="Supprimer l'ec">
                                    <i style="padding:2px 3px;border-radius:20px 20px 20px 20px;" class="btn-danger fa fa-trash-o"></i>
                                </a>
                              </h4>
                            </div>
                            <div id="collapseMatiere<?php echo $ecId; ?>" class="panel-collapse collapse">
                              <table class="table">
                                  <tr>
                                      <td>
                                          <div class="input-group">
                                            <span class="input-group-addon">Code EC</span>
                                            <input type="text" onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');"  id="<?php _hashName("ec_code","_".$ecId);  ?>" value="<?php echo $codeEc; ?>" class="form-control" placeholder="Code EC">
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div class="input-group">
                                            <span class="input-group-addon">Matière</span>
                                            <input type="text"  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');"  id="<?php _hashName("ec_nom","_".$ecId);  ?>"  value="<?php echo $matiere; ?>" class="form-control" placeholder="Matière">
                                          </div>
                                      </td>
                                  </tr>

                                  <tr>
                                      <td>
                                          <table class="table">
                                              <tr>
                                                  <td><label for="<?php _hashName("ec_coef","_".$ecId); ?>">Coefficient
                                                      <i title="Suggestions" style="cursor:pointer;color:blue" onclick="loadSuggest('ec','coef',<?php echo $ecId; ?>,'sug_ec_coef<?php echo $ecId; ?>');" class="fa fa-lightbulb-o" aria-hidden="true"></i>
</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_cm","_".$ecId); ?>">Nombre d'heures CM</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_td","_".$ecId); ?>">Nombre d'heures TD</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_tp","_".$ecId); ?>">Nombre d'heures TP</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_tpe","_".$ecId); ?>">Nombre d'heures TPE</label></td>
                                              </tr>
                                              <tr>
                                                  <td><input onKeyUp="changeInfosCoefEc(<?php echo $ecId; ?>,this.value);"  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');"  id="<?php _hashName("ec_coef","_".$ecId);  ?>"           type="number" class="form-control" value="<?php echo $coef; ?>" min=1 placeholder="Coefficient"></td>
                                                  <td><input  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');changeShowUeInfos(<?php echo $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);"  id="<?php _hashName("ec_nbre_heure_cm","_".$ecId);  ?>" onKeyUp="changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);" type="number"    min=0 max=600 class="form-control inUe<?php echo $ue_id; ?>" value="<?php echo $nbrHeurCM; ?>" placeholder="Nombre d'heures CM"></td>
                                                  <td><input  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);"  id="<?php _hashName("ec_nbre_heure_td","_".$ecId); ?>"  onKeyUp="changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);" type="number"    min=0 max=600 class="form-control inUe<?php echo $ue_id; ?>" value="<?php echo $nbrHeurTD; ?>" placeholder="Nombre d'heures TD"></td>
                                                  <td><input  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);"  id="<?php _hashName("ec_nbre_heure_tp","_".$ecId); ?>"  onKeyUp="changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);" type="number"    min=0 max=600 class="form-control inUe<?php echo $ue_id; ?>" value="<?php echo $nbrHeurTP; ?>" placeholder="Nombre d'heures TP"></td>
                                                  <td><input  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);"  id="<?php _hashName("ec_nbre_heure_tpe","_".$ecId); ?>" onKeyUp="changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',true);" type="number"    min=0 max=600 class="form-control inUe<?php echo $ue_id; ?>" value="<?php echo $nbrHeurTPE; ?>" placeholder="Nombre d'heures TPE"></td>
                                              </tr>
                                              <tr>
                                                  <td colspan="5">
                                                      <div id="sug_ec_coef<?php echo $ecId; ?>" style="text-align: justify;" class="suggestion hide">

                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>

                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                            <span class="input-group-addon">Compétences<br />
                                                <i title="Suggestions" style="cursor:pointer;color:blue" onclick="loadSuggest('ec','competence',<?php echo $ecId; ?>,'sug_ec_competence<?php echo $ecId; ?>');" class="fa fa-2x fa-lightbulb-o" aria-hidden="true"></i>
                                            </span>
                                            <div id="sug_ec_competence<?php echo $ecId; ?>" style="text-align: justify;" class="suggestion hide">

                                            </div>
                                            <textarea  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');" id="<?php _hashName("ec_competence","_".$ecId); ?>" style="text-align:justified;width:100%;background-color:ghostwhite" rows="8" ><?php echo $competence; ?></textarea>

                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                            <span  class="input-group-addon">Prérequis<br />
                                                <i title="Suggestions" style="cursor:pointer;color:blue" onclick="loadSuggest('ec','prerequis',<?php echo $ecId; ?>,'sug_ec_prerequis<?php echo $ecId; ?>');" class="fa fa-2x fa-lightbulb-o" aria-hidden="true"></i>
                                            </span>
                                            <div id="sug_ec_prerequis<?php echo $ecId; ?>" style="text-align: justify;" class="suggestion hide">

                                            </div>
                                            <textarea  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');" id="<?php _hashName("ec_prerequis","_".$ecId); ?>" style="text-align:justified;width:100%" rows="5" ><?php echo $prerequis; ?></textarea>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                            <span class="input-group-addon">Contenu<br />
                                                <i title="Suggestions" style="cursor:pointer;color:blue" onclick="loadSuggest('ec','contenu',<?php echo $ecId; ?>,'sug_ec_contenu<?php echo $ecId; ?>');" class="fa fa-2x fa-lightbulb-o" aria-hidden="true"></i>
                                            </span>
                                            <div id="sug_ec_contenu<?php echo $ecId; ?>" style="text-align: justify;" class="suggestion hide">

                                            </div>
                                            <textarea  onchange="regChangeEc(this.id,this.value,'notifChangedEc<?php echo $ue_id; ?>');" id="<?php _hashName("ec_contenu","_".$ecId); ?>" style="text-align:justified;width:100%" rows="8" ><?php echo $contenu; ?></textarea>
                                          </div>
                                      </td>
                                  </tr>
                              </table>
                            </div>
                          </div>
                    </div>
                      <?php
                  }
                  ?>
                  <script type="text/javascript">
                      changeShowUeInfos(<?php echo  $classId.",".$ue_id; ?>,'showInfosCreditUe<?php echo $ue_id; ?>',false);
                  </script>
                  <?php
              }
              ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
          </div>
        </div>
      </div>
    </div>
    <?php
}

function getFormInvariants(){
    global $contenu;
    $PROJET=new Projet;
    ?>
    <form action="" method="POST">
        <?php
            $currentInvariantId=0;
            for ($i=0; $i < count($contenu) ; $i++) {
                $currentInvariantId = $contenu[$i]['invariant_id'];
                $currentInvariantNom = $contenu[$i]['invariant_nom'];
                $currentInvariantContenu = $contenu[$i]['invariant_contenu'];
                ?>
                <div id="invariant<?php echo $currentInvariantId; ?>" <?php if($i!=0){echo 'style="display:none"';} ?> class="tabcontent">
                    <h5 style="text-align:center"><?php echo $currentInvariantNom ?></h5>
                    <input type="hidden" name="invariantId[]" value="<?php echo $currentInvariantId; ?>">
                    <textarea class="form-control" id="editor<?php echo $currentInvariantId; ?>" name="invariantContent[]" placeholder="Enter text ...">
                        <?php echo $currentInvariantContenu; ?>
                    </textarea>
                    <script>
                        CKEDITOR.replace('editor<?php echo $currentInvariantId; ?>', {
                            height: '750px'
                        });
                    </script>
                </div>
                <?php
            }
        ?>
        <div id="invariant<?php echo $currentInvariantId+1; ?>"  style="display:<?php if($currentInvariantId==0){ echo 'block';}else{ echo 'none';} ?>;min-height:880px" class="tabcontent">
            <h5 style="text-align:center">Liste des formations</h5>
            <?php
            if($formations = $PROJET->getFormations()){
                ?><ul style="text-align:center"><?php
                for ($i=0; $i <count($formations) ; $i++) {
                    $formationName = $formations[$i]["formation_nom"];
                    $formationId = $formations[$i]["formation_id"];
                    $formationOrganisation = $formations[$i]["formation_organisation"];
                    $formationEvaluation = $formations[$i]["formation_evaluation"];
                    $formationAutresInfos = $formations[$i]["formation_autres_infos"];
                    $formationNomComplet = $formations[$i]["formation_nom_complet"];
                    ?>
                    <li>
                        <div class="modal fade" style="width:100%" id="invForm<?php echo $formationId;  ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="">invariants relatifs à la formation <?php echo $formationName;  ?></h4>
                              </div>
                              <div class="modal-body">
                                  <input type="hidden" name="formationId[]" value="<?php echo $formationId; ?>">
                                  <div class="input-group">
                                    <span class="input-group-addon">Nom complet formation</span>
                                    <input type="text" autocomplete="off" name="formationNomComplet[]" class="form-control" value="<?php echo $formationNomComplet; ?>" placeholder="Ex : Le Diplôme universitaire de technologie en informatique">
                                </div><br />
                                   <div class="panel-group" id="accordionInvFor<?php echo $formationId; ?>">
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" style="display:block" data-parent="#accordionInvFor<?php echo $formationId; ?>" href="#collapseInvFor<?php echo $formationId; ?>1">
                                                Extraits d’arrêté organisant la formation
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapseInvFor<?php echo $formationId; ?>1" class="panel-collapse collapse">
                                          <div class="panel-body">
                                              <textarea class="form-control" id="editorInvFormOrganisation<?php echo $formationId; ?>" name="formationOrganisation[]" placeholder="Enter text ...">
                                                  <?php echo $formationOrganisation; ?>
                                              </textarea>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" style="display:block" data-parent="#accordionInvFor<?php echo $formationId; ?>" href="#collapseInvFor<?php echo $formationId; ?>2">
                                                Evaluation
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapseInvFor<?php echo $formationId; ?>2" class="panel-collapse collapse">
                                          <div class="panel-body">
                                              <textarea class="form-control" id="editorInvFormEvaluation<?php echo $formationId; ?>" name="formationEvaluation[]" placeholder="Enter text ...">
                                                  <?php echo ($formationEvaluation)?$formationEvaluation:"<p>
                                                  <b>Evaluation:</b> CC (33%) + DS (67%). Si les enseignements pratiques sont évalués, la note de CC est calculée de la manière suivante: CC=TP (40%) + Contrôle (60%).
                                                  </p>"; ?>
                                              </textarea>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" style="display:block" data-parent="#accordionInvFor<?php echo $formationId; ?>" href="#collapseInvFor<?php echo $formationId; ?>3">
                                                Les autres informations utiles
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapseInvFor<?php echo $formationId; ?>3" class="panel-collapse collapse">
                                          <div class="panel-body">
                                              <textarea class="form-control" id="editorInvFormAutresInfos<?php echo $formationId; ?>" name="formationAutresInfos[]" placeholder="Enter text ...">
                                                  <?php echo $formationAutresInfos; ?>
                                              </textarea>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a style="display:block;margin-bottom:3px;background-color:#d9d6de;color:#0d3f65;font-weight:bold" class="btn" data-toggle="modal" href="#invForm<?php echo $formationId;  ?>"><?php echo ($formationNomComplet)?$formationNomComplet:$formationName; ?></a>
                        <script>
                            CKEDITOR.replace('editorInvFormOrganisation<?php echo $formationId; ?>', {
                                height: '500px'
                            });
                        </script>
                        <script>
                            CKEDITOR.replace('editorInvFormEvaluation<?php echo $formationId; ?>', {
                                height: '100px'
                            });
                        </script>
                        <script>
                            CKEDITOR.replace('editorInvFormAutresInfos<?php echo $formationId; ?>', {
                                height: '250px'
                            });
                        </script>
                    </li>
                    <?php
                }
                ?></ul><?php
            }else{
                echo center("Aucune formation pour ce projet<br /><a style='color:blue' href='index.php?page=importFormation'>Importer </a> une formation maintenant ?");
            }
            ?>
        </div>
        <center>
            <input type="submit" name="modifInvariant" class="btn btn-success" value="Enregistrer">
        </center>
    </form>
    <?php
}
?>
<script type="text/javascript">
    function getTitle(cible,attrib,id,idResult){
        return "<div style='background-color:blanchedalmond;padding:5px;font-size: 17px;font-weight: bold;' class='text-center col-md-12'>Suggestion(s) liée(s) à <i>'"+cible+" >> "+attrib+"'</i> <i title='Réduire la suggestion' onclick='hideContentSugges(\""+idResult+"\");' style='cursor:pointer;float:right' class='fa fa-2x fa-angle-down'></i></div>";
    }
    function hideContentSugges(idResult){
        document.getElementById(idResult).className = document.getElementById(idResult).className.replace(" active"," hide");
    }
    function loadSuggest(cible,attrib,id,idResult){
        document.getElementById(idResult).className = document.getElementById(idResult).className.replace(" hide"," active");
       $.ajax({
         url: "index.php?page=assync.loadSuggest&cible="+cible+"&id="+id+"&attrib="+attrib,
         type: "GET",

         processData: false,
         contentType: false
     }).done(function( data ) {
           document.getElementById(idResult).innerHTML=getTitle(cible,attrib,id,idResult)+data;
       });
       return false;
    }
</script>
