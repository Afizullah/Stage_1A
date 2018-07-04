<?php

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
    ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
              <span class="input-group-addon">Nom du groupe : </span>
              <input required type="text" class="form-control" name="groupe_nom" value="<?php echo $nomGroup; ?>" placeholder="Ex: Informatique">
        </div><br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addGroup" value="Créer un groupe">
        </center>
    </form>

    <?php
}
function getHiddenInput($name,$value){ ?>
    <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>"> <?php
}
function getFormEditEc($class,$ue,$ue_id){
    ?>
    <div class="modal fade" id="modalEcUe<?php echo $ue_id; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h5 style="float:left" class="modal-title" id=""><span style="color:red"><?php echo $class."</span> <i class='fa fa-angle-double-right'></i><span style='color:blue'> ".$ue; ?></span></h5>
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
                                <a style="display:block" data-toggle="collapse" href="#collapseMatiere<?php echo $ecId; ?>"><?php $nomMatiere = ($matiere)?$matiere:"Matière non définie"; echo $nomMatiere; ?></a>
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
                                            <input type="text"   id="<?php _hashName("ec_nom","_".$ecId);  ?>"  value="<?php echo $matiere; ?>" class="form-control" placeholder="Matière">
                                          </div>
                                      </td>
                                  </tr>

                                  <tr>
                                      <td>
                                          <table class="table">
                                              <tr>
                                                  <td><label for="<?php _hashName("ec_coef","_".$ecId); ?>">Coefficient</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_cm","_".$ecId); ?>">Nombre d'heures CM</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_td","_".$ecId); ?>">Nombre d'heures TD</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_tp","_".$ecId); ?>">Nombre d'heures TP</label></td>
                                                  <td><label for="<?php _hashName("ec_nbre_heure_tpe","_".$ecId); ?>">Nombre d'heures TPE</label></td>
                                              </tr>
                                              <tr>
                                                  <td><input  id="<?php _hashName("ec_coef","_".$ecId);  ?>"  type="text" class="form-control" value="<?php echo $coef; ?>" placeholder="Coefficient"></td>
                                                  <td><input  id="<?php _hashName("ec_nbre_heure_cm","_".$ecId);  ?>"  type="text" class="form-control" value="<?php echo $nbrHeurCM; ?>" placeholder="Nombre d'heures CM"></td>
                                                  <td><input  id="<?php _hashName("ec_nbre_heure_td","_".$ecId); ?>" type="text" class="form-control" value="<?php echo $nbrHeurTD; ?>" placeholder="Nombre d'heures TD"></td>
                                                  <td><input  id="<?php _hashName("ec_nbre_heure_tp","_".$ecId); ?>" type="text" class="form-control" value="<?php echo $nbrHeurTP; ?>" placeholder="Nombre d'heures TP"></td>
                                                  <td><input  id="<?php _hashName("ec_nbre_heure_tpe","_".$ecId); ?>" type="text" class="form-control" value="<?php echo $nbrHeurTPE; ?>" placeholder="Nombre d'heures TPE"></td>
                                              </tr>
                                          </table>

                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                            <span class="input-group-addon">Compétences</span>
                                            <textarea id="<?php _hashName("ec_competence","_".$ecId); ?>" style="text-align:justified;width:100%" rows="8" ><?php echo $competence; ?></textarea>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                            <span  class="input-group-addon">Prérequis</span>
                                            <textarea id="<?php _hashName("ec_prerequis","_".$ecId); ?>" style="text-align:justified;width:100%" rows="5" ><?php echo $prerequis; ?></textarea>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                            <span class="input-group-addon">Contenu</span>
                                            <textarea id="<?php _hashName("ec_contenu","_".$ecId); ?>" style="text-align:justified;width:100%" rows="8" ><?php echo $contenu; ?></textarea>
                                          </div>
                                      </td>
                                  </tr>
                              </table>
                            </div>
                          </div>
                    </div>
                      <?php
                  }
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
function getFormEditUe($idForm,$clss,$idSem,$idUe,$codeUe,$detaillesUe,$ecUe){
    $id= $idForm.$clss.$idSem.$idUe; ?>
    <div class="modal fade" id="<?php echo "infosUe".$id; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5  class="modal-title" id="">Informations de l'UE <?php echo $codeUe."<span style='color:blue'> (".$detaillesUe['CodeUeIntitule'].")</span>"; ?></h5>
            <button style="position:absolute;right:30px;top:20px" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
              <center>
                  <?php
                      $_ueClasse = "ues_classe_semestre".$idForm.$clss.$idSem."[]";
                      getHiddenInput($_ueClasse,$detaillesUe["classe"]);
                      $_ueCode = "ues_code_semestre".$idForm.$clss.$idSem."[]";
                      $_ueNom = "ues_nom_semestre".$idForm.$clss.$idSem."[]";
                      $_ueNbrCredit = "ues_nbrCredit_semestre".$idForm.$clss.$idSem."[]";
                      $_ueSemestre = "ues_Semestre_semestre".$idForm.$clss.$idSem."[]";
                   ?>
              <table>
                  <caption style="text-align:center;font-weight:bold;font-size:15px;color:red;text-decoration:underline">Informations relatives à l'UE</caption>
                  <tr>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Code UE</span>
                            <input type="text" class="form-control" name="<?php echo $_ueCode; ?>" value="<?php echo $codeUe; ?>" placeholder="Code UE">
                          </div>
                      </td>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Intitulé UE</span>
                            <input type="text" class="form-control" name="<?php echo $_ueNom; ?>" value="<?php echo $detaillesUe["CodeUeIntitule"]; ?>" placeholder="Intitulé de  l'UE">
                          </div>
                      </td>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Nombre de credits UE</span>
                            <input type="text" class="form-control" name="<?php echo $_ueNbrCredit; ?>" value="<?php echo $detaillesUe["credit"]; ?>" placeholder="Le nombre de credits de l'UE">
                          </div>
                      </td>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Semestre</span>
                            <input type="text" class="form-control" name="<?php echo $_ueSemestre; ?>" value="<?php echo $detaillesUe["semestre"]; ?>" placeholder="Le numéro du semestre">
                          </div>
                      </td>
                  </tr>
              </table>
              <br />
              <h4>Les matières de l'UE</h4><hr />
              <?php
              for ($i=0; $i < count($ecUe["CodeEC"]); $i++) {
                  $codeEc = $ecUe["CodeEC"][$i];
                  $TypeCompetence = $ecUe["TypeCompetence"][$i];
                  $competence = $ecUe["competence"][$i];
                  $matiere = $ecUe["matiere"][$i];
                  $prerequis = $ecUe["prerequis"][$i];
                  $contenu = $ecUe["contenu"][$i];
                  $coef = $ecUe["coef"][$i];
                  $nbrHeurCM = $ecUe["nbrHeurCM"][$i];
                  $nbrHeurTD = $ecUe["nbrHeurTD"][$i];
                  $nbrHeurTP = $ecUe["nbrHeurTP"][$i];
                  $nbrHeurTPE = $ecUe["nbrHeurTPE"][$i];
                  ?>
                  <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a style="display:block" data-toggle="collapse" href="#collapse<?php echo $id.$i; ?>"><?php $nomMatiere = ($matiere)?$matiere:"Matière non définie"; echo $nomMatiere; ?></a>
                          </h4>
                        </div>
                        <div id="collapse<?php echo $id.$i; ?>" class="panel-collapse collapse">
                          <table class="table">
                              <tr>
                                  <td>
                                      <div class="input-group">
                                        <span class="input-group-addon">Code EC</span>
                                        <input type="text" name="code_ec_form<?php echo $id.$i."[]"; ?>" value="<?php echo $codeEc; ?>" class="form-control" placeholder="Code EC">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div class="input-group">
                                        <span class="input-group-addon">Matière</span>
                                        <input type="text"  name="nom_ec_form<?php echo $id.$i."[]"; ?>" value="<?php echo $matiere; ?>" class="form-control" placeholder="Matière">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div class="input-group">
                                        <span class="input-group-addon">Type de compétence</span>
                                        <input  name="type_compt_ec_form<?php echo $id.$i."[]"; ?>" type="text" value="<?php echo $TypeCompetence; ?>" class="form-control" placeholder="Code EC">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <table class="table">
                                          <tr>
                                              <td><label for="<?php echo "coef".$id.$i; ?>">Coefficient</label></td>
                                              <td><label for="<?php echo "nbrHCM".$id.$i; ?>">Nombre d'heures CM</label></td>
                                              <td><label for="<?php echo "nbrHTD".$id.$i; ?>">Nombre d'heures TD</label></td>
                                              <td><label for="<?php echo "nbrHTP".$id.$i; ?>">Nombre d'heures TP</label></td>
                                              <td><label for="<?php echo "nbrHTPE".$id.$i; ?>">Nombre d'heures TPE</label></td>
                                          </tr>
                                          <tr>
                                              <td><input  name="coef_ec_form<?php echo $id.$i."[]"; ?>" id="<?php echo "coef".$id.$i; ?>" type="text" class="form-control" value="<?php echo $coef; ?>" placeholder="Coefficient"></td>
                                              <td><input  name="hcm_ec_form<?php echo $id.$i."[]"; ?>" id="<?php echo "nbrHCM".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurCM; ?>" placeholder="Nombre d'heures CM"></td>
                                              <td><input  name="htd_ec_form<?php echo $id.$i."[]"; ?>" id="<?php echo "nbrHTD".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurTD; ?>" placeholder="Nombre d'heures TD"></td>
                                              <td><input  name="htp_ec_form<?php echo $id.$i."[]"; ?>" id="<?php echo "nbrHTP".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurTP; ?>" placeholder="Nombre d'heures TP"></td>
                                              <td><input  name="htpe_ec_form<?php echo $id.$i."[]"; ?>" id="<?php echo "nbrHTPE".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurTPE; ?>" placeholder="Nombre d'heures TPE"></td>
                                          </tr>
                                      </table>
                                      <div class="input-group">
                                        <span class="input-group-addon">Type de compétence</span>
                                        <input name="type_compte<?php echo $id.$i."[]"; ?>" type="text" value="<?php echo $TypeCompetence; ?>" class="form-control" placeholder="Code EC">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                        <span class="input-group-addon">Compétences</span>
                                        <textarea name="competences<?php echo $id.$i."[]"; ?>" style="text-align:justified;width:100%" rows="8" ><?php echo $competence; ?></textarea>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                        <span  class="input-group-addon">Prérequis</span>
                                        <textarea name="prerequis<?php echo $id.$i."[]"; ?>" style="text-align:justified;width:100%" rows="5" ><?php echo $prerequis; ?></textarea>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                        <span class="input-group-addon">Contenu</span>
                                        <textarea style="text-align:justified;width:100%" name="name" rows="8" ><?php echo $contenu; ?></textarea>
                                      </div>
                                  </td>
                              </tr>
                          </table>
                        </div>
                      </div>
                </div> <?php
                } ?>
              </center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <?php
}
 ?>
