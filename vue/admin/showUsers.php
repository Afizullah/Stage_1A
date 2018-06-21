<div class="container mt-3">
  <h2>Dynamic Tabs with jQuery</h2>
  <p>Click on the Tabs to display the active and previous tab.</p>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#home">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#menu1">Menu 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#menu2">Menu 2</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content border mb-3">
    <div id="home" class="container tab-pane active"><br>
      <h3>HOME</h3>
      <div>
        <div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Basic Table</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<p class="text-muted">Add class <code>table</code> in table tag.</p>
									<div class="table-wrap mt-40">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
												  <tr>
													<th>User ID</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<th>Account Type</th>
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
													<td><span class="label label-danger">admin</span> </td>
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
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
  <p class="act"><b>Active Tab</b>: <span></span></p>
  <p class="prev"><b>Previous Tab</b>: <span></span></p>
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
