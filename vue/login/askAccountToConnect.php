
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->

		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.php">
						<img class="brand-img mr-10" src="<?php echo PATH_TEMPLATE; ?>dist/img/logo.png" alt="logo"/>
						<span class="brand-text"><?php echo APP_NAME; ?></span>
					</a>
				</div>

				<div class="clearfix"></div>
			</header>

			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Choisir le compte</h3>
                                            <hr>
										</div>
										<div class="form-wrap">
                                            <div class="col-lg-12">
                                                <?php
                                                    if($comptes = $_SESSION["livretSession"]){
                                                        foreach ($comptes as $compte) {
                                                            ?>
                                                            <form action="" method="post">
																<input type="hidden" name="choosedAccount" value="<?php echo $compte["compte_typeCompte"];  ?>">
                                                                <input type="submit" style="background-color:#6a6bf8;border:0px;" value="<?php echo implode(" ",(explode("_",$compte["compte_typeCompte"]))); ?>" class="col-lg-12 btn btn-info" type="button" name="confirmChoix" />
															</form>
															<br /><br /><br />
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->
				</div>

			</div>
			<!-- /Main Content -->

		</div>
		<!-- /#wrapper -->
