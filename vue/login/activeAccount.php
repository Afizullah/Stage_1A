    <?php require_once(PATH_VUE."login/forms.php"); ?>
    <?php require_once(PATH_VUE."login/messages.php"); ?>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->

		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="<?php echo PATH_TEMPLATE; ?>dist/img/logo.png" alt="brand"/>
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
											<h4 class="text-center txt-dark mb-10"><i class="fa fa-user"></i><br />Activez le compte</h4>
                                            <hr>
										</div>
										<div class="form-wrap">
                                            <div>
                                                <?php

                                                    if(isset($errors)){
                                                        //die("ok");
                                                        alertErrors($errors);

                                                    }

                                                 ?>
                                            </div>
                                            <?php
                                            if(isset($_REQUEST["token"])){
                                                $token = secure($_REQUEST["token"]);
                                                getFormActiveAccount($token);
                                            }else{
                                                getMsgActiveAccountFailled();
                                            }
                                             ?>
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
