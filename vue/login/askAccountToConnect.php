
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->

		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="https://hencework.com/theme/grandin-demo/img/logo.png" alt="brand"/>
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
                                                            <a  class="" href="index.php?">
                                                                <button style="background-color:#6a6bf8;border:0px;	" class="col-lg-12 btn btn-info" type="button" name="button">
                                                                    <?php echo implode(" ",(explode("_",$compte["compte_typeCompte"]))); ?>
                                                                </button>
																<br />
																<br />
																<br />
                                                            </a>


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
