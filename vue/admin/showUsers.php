<div class="container mt-3">
  <h2>Liste des utilisateurs de la plateforme</h2>
  <!-- <p>Click on the Tabs to display the active and previous tab.</p> -->

  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#administrateur">Administrateur</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#enseignant">Enseignant</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#respons">Responsable Pédagogique</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content border mb-3">
    <div id="administrateur" class="container tab-pane active"><br>
      <h3>Administrateur</h3>
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
    <div id="enseignant" class="container tab-pane fade"><br>
      <h3>Enseignant</h3>
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
                                                        <th>Test</th>
                                                        <?php
                                                    }
                                                     ?>
													<!-- <th>Account Type</th> -->
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

                                                            <select class="form-control">
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
      <h3>Responsable Pédagogique</h3>
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
  <p class="act"><b>Liste actuelle </b>: <span></span></p>
  <p class="prev"><b>Liste précédente </b>: <span></span></p>
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
</script>
