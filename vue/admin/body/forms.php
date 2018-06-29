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

function getHiddenInput($name,$value){
    ?>
    <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
    <?php
}

function getFormEditUe($idForm,$idSem,$idUe,$codeUe,$detaillesUe,$ecUe){
    $id= $idForm.$idSem.$idUe;
    ?>
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
                      $_ueClasse = "ues_classe_semestre".$idForm.$idSem."[]";
                      getHiddenInput($_ueClasse,$detaillesUe["classe"]);
                      $_ueCode = "ues_code_semestre".$idForm.$idSem."[]";
                      $_ueNom = "ues_nom_semestre".$idForm.$idSem."[]";
                      $_ueNbrCredit = "ues_nbrCredit_semestre".$idForm.$idSem."[]";
                      $_ueSemestre = "ues_Semestre_semestre".$idForm.$idSem."[]";
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
                                        <input type="text" name="code_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" value="<?php echo $codeEc; ?>" class="form-control" placeholder="Code EC">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div class="input-group">
                                        <span class="input-group-addon">Matière</span>
                                        <input type="text"  name="nom_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" value="<?php echo $matiere; ?>" class="form-control" placeholder="Matière">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div class="input-group">
                                        <span class="input-group-addon">Type de compétence</span>
                                        <input  name="type_compt_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" type="text" value="<?php echo $TypeCompetence; ?>" class="form-control" placeholder="Code EC">
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
                                              <td><input  name="coef_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" id="<?php echo "coef".$id.$i; ?>" type="text" class="form-control" value="<?php echo $coef; ?>" placeholder="Coefficient"></td>
                                              <td><input  name="hcm_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" id="<?php echo "nbrHCM".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurCM; ?>" placeholder="Nombre d'heures CM"></td>
                                              <td><input  name="htd_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" id="<?php echo "nbrHTD".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurTD; ?>" placeholder="Nombre d'heures TD"></td>
                                              <td><input  name="htp_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" id="<?php echo "nbrHTP".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurTP; ?>" placeholder="Nombre d'heures TP"></td>
                                              <td><input  name="htpe_ec_form<?php echo $idForm."sem".$idSem."ue".$idUe."[]"; ?>" id="<?php echo "nbrHTPE".$id.$i; ?>" type="text" class="form-control" value="<?php echo $nbrHeurTPE; ?>" placeholder="Nombre d'heures TPE"></td>
                                          </tr>
                                      </table>
                                      <div class="input-group">
                                        <span class="input-group-addon">Type de compétence</span>
                                        <input type="text" value="<?php echo $TypeCompetence; ?>" class="form-control" placeholder="Code EC">
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                        <span class="input-group-addon">Compétences</span>
                                        <textarea style="text-align:justified;width:100%" name="name" rows="8" ><?php echo $competence; ?></textarea>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div title="<?php echo $nomMatiere; ?>"  class="input-group">
                                        <span  class="input-group-addon">Prérequis</span>
                                        <textarea style="text-align:justified;width:100%" name="name" rows="5" ><?php echo $prerequis; ?></textarea>
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
                </div>
                <?php
                }
                ?>
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
