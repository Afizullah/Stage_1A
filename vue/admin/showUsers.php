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
<div style="background-color:white;padding:20px" class="container mt-3">
  <div style="text-align: center;">
      <h3>Liste des utilisateurs de la plateforme</h3>
  </div>
  <!-- <p>Click on the Tabs to display the active and previous tab.</p> -->

  <!-- Nav tabs -->
  <ul class="nav nav-tabs">

    <li class="nav-item active">
      <a class="nav-link" href="#enseignant">Enseignant</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="#administrateur">Administrateur</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#respons">Responsable Pédagogique</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content border mb-3">
      <div id="enseignant" class="container tab-pane active "><br>
        <div>
          <div class="col-sm-12">
  						<div class="panel panel-default card-view">
  							<div class="panel-heading">
  								<div class="pull-left">
  									<h6 class="panel-title txt-dark">Enseignant</h6>
  								</div>
  								<div class="clearfix"></div>
  							</div>
  							<div class="panel-wrapper collapse in">
  								<div class="panel-body">
  									<!-- <p class="text-muted">Add class <code>table</code> in table tag.</p> -->
  									<div class="table-wrap mt-40">
  										<div class="table-responsive">
                                              <?php
                                              $hasGroupe= $PROJET->getGroupes();
                                              if($hasGroupe){

                                                  ?>
                                                  <div style="text-align: center;">
                                                      <h5>Gestion des comptes <i>(<?php echo $PROJET->getName(); ?>)</i></h5>
                                                  </div>
                                                  <?php echo $html ?>
                                                  <form class="" action="" method="post">
                                                      <label for="notifEnseignant">Notifier les enseignants des changements </label>
                                                      <input type="checkbox" id="notifEnseignant" name="notifEnseignant" value="ok">
  																										<input type="hidden" name="project_id" value="<?php echo $PROJET->getId(); ?>">
                                                  <?php
                                              }
                                               ?>
  											<table class="table mb-0">
  												<thead>
  												  <tr>
  													<th>User ID</th>
  													<th>First Name</th>
  													<th>Last Name</th>
  													<th>Email</th>
                                                      <?php
                                                      if($hasGroupe){
                                                          ?>
                                                          <th>Groupe</th>
                                                          <?php
                                                      }
                                                       ?>
  													<!-- <th>Account Type</th> -->
                             <th>Responsable pédagogique</th>
  												  </tr>
  												</thead>
  												<tbody>
                          <?php
                            $dataUser = ShowUsers::getEnseignant();
                            for($i = 0; $i < count($dataUser); $i++) {

                          ?>
  												  <tr>
  													<td><?php print_r($dataUser[$i]['user_id']); ?></td>
  													<td><?php print_r($dataUser[$i]['user_prenom']); ?></td>
  													<td><?php print_r($dataUser[$i]['user_nom']); ?></td>
  													<td><?php print_r($dataUser[$i]['user_mail']); ?></td>
                                                      <?php
                                                      if($hasGroupe){
                                                          ?>
                                                          <td>

                                                              <select name="link[]" class="form-control">
                                                                  <option value="">---Sélectionner---</option>
                                                              <?php

                                                                  foreach ($hasGroupe as $onGroupe=>$value) {
                                                                      ?>
                                                                      <option <?php if($PROJET->getGroupeForUser($dataUser[$i]['user_id'],$value["groupe_id"])){ echo "selected"; } ?> value="<?php echo $dataUser[$i]['user_id'].";".$value["groupe_id"]; ?>"><?php echo $value["groupe_specialite"]; ?></option>
                                                                      <?php
                                                                  }

                                                                  ?>
                                                              </select>
                                                      </td>

                                                          <?php
                                                      }
                                                       ?>
                            <td>
                              <select name="link2[]" class="form-control">
                                  <option value=<?php echo $dataUser[$i]['user_id'];?> >---Sélectionner---</option>
                              <?php
                                  $RP=ShowUsers::getFormationRP($dataUser[$i]['user_id']);
                                  $formations=showUsers::getFormations($projet_id);
                                  foreach ($formations as $currentForm) {
                                      //echo var_dump($formations);
                                      ?>

                                      <option <?php if(isset($RP[0]) && ($currentForm['formation_id']==$RP[0]['formation_id'])){ echo "selected"; } ?> value="<?php echo $dataUser[$i]['user_id'].";".$currentForm['formation_id']; ?>"><?php echo $currentForm['formation_nom']; ?></option>
                                      <?php
                                  }

                                  ?>
                              </select>
                            </td>

  													<!-- <td><span class="label label-danger">admin</span> </td> -->
                            </tr>
                            <?php } ?>
  												</tbody>
  											</table>
                                              <?php
                                              if($hasGroupe){

                                                  ?>
                                                  <div style="text-align: center;"><br /><br />
                                                      <input class="btn btn-success" type="submit" name="editGroupeListe" value="Enregistrer les modifications" />
                                                  </div>
                                              </form>
                                                  <?php
                                              }

                                               ?>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
        </div>
      </div>
      
    <div id="administrateur" class="container tab-pane fade"><br>
      <div>
        <div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Administrateur</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<!-- <p class="text-muted">Add class <code>table</code> in table tag.</p> -->
									<div class="table-wrap mt-40">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
												  <tr>
													<th>User ID</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<!-- <th>Account Type</th> -->
												  </tr>
												</thead>
												<tbody>
                        <?php
                          $dataUser = ShowUsers::getAdmin();
                          for($i = 0; $i < count($dataUser); $i++) {

                        ?>
												  <tr>
													<td><?php print_r($dataUser[$i]['user_id']); ?></td>
													<td><?php print_r($dataUser[$i]['user_prenom']); ?></td>
													<td><?php print_r($dataUser[$i]['user_nom']); ?></td>
													<td><?php print_r($dataUser[$i]['user_mail']); ?></td>
													<!-- <td><span class="label label-danger">admin</span> </td> -->
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
    </div>
    <div id="respons" class="container tab-pane fade"><br>
      <div>
        <div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Responsable Pédagogique</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<!-- <p class="text-muted">Add class <code>table</code> in table tag.</p> -->
									<div class="table-wrap mt-40">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
												  <tr>
													<th>User ID</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<!-- <th>Account Type</th> -->
												  </tr>
												</thead>
												<tbody>
                        <?php
                          $dataUser = ShowUsers::getRespons();
                          for($i = 0; $i < count($dataUser); $i++) {

                        ?>
												  <tr>
													<td><?php print_r($dataUser[$i]['user_id']); ?></td>
													<td><?php print_r($dataUser[$i]['user_prenom']); ?></td>
													<td><?php print_r($dataUser[$i]['user_nom']); ?></td>
													<td><?php print_r($dataUser[$i]['user_mail']); ?></td>
													<!-- <td><span class="label label-danger">admin</span> </td> -->
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
    </div>
  </div>

</div>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
});

