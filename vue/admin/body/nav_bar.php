<!--Preloader--
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->
<div class="wrapper theme-1-active pimary-color-pink">

<!-- Top Menu Items -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="index.php?page=<?php echo DEFAULT_PAGE; ?>">
                    <img class="brand-img img-circle" src="<?php echo URL_LOGO; ?>" alt="logo"/>
                    <span class="brand-text"><?php echo APP_NAME;  ?></span>
                </a>
            </div>
        </div>
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        <form id="search_form" role="search" class="top-nav-search collapse pull-left">
            <div class="input-group">
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                </span>
            </div>
        </form>
    </div>
    <div class="mobile-only-nav pull-left">
        <div style="width:580px;position:fixed;top:20px;" class="nav-header">
            <form id="formProjetName" method="post">
                <input type="hidden" name="projectId" value="<?php echo $PROJET->getId(); ?>">
                <h6 style="overflow:hidden">
                    <input required style="border:0px" onchange="changeProjectName(this)" type="text" name="newProjectName" value="<?php echo $PROJET->getName(); ?>">
                    <span style="" id="notifChangedProjectName"></span>
                </h6>
            </form>
            <span id="notifChanged"></span>
        </div>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li>
                <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
            </li>
            <li class="dropdown app-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-apps top-nav-icon"></i></a>
                <ul class="dropdown-menu app-dropdown" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
                    <li>
                        <div class="app-nicescroll-bar">
                            <ul class="app-icon-wrap pa-10">
                                <?php
                                if(isset($_SESSION["livretSession"])){
                                    $mesComptes = $_SESSION["livretSession"];
                                    for ($i=0; $i < count($mesComptes); $i++) {
                                        $type_compte = $mesComptes[$i]["compte_typeCompte"];
                                        switch ($type_compte) {
                                            case 'administrateur':
                                                ?>
                                                <li>
                                                    <a href="<?php echo PATH_CONTROLEUR; ?>login/askAccountToConnect.php?choosedAccount=administrateur&confirmChoix=true&currentSess=administrateur" class="connection-item">
                                                        <i class="zmdi zmdi-cloud-outline txt-info"></i>
                                                        <span class="block">Admin</span>
                                                    </a>
                                                </li>
                                                <?php
                                                break;
                                            case 'enseignant':
                                                ?>

                                                <li>
                                                    <a href="<?php echo PATH_CONTROLEUR; ?>login/askAccountToConnect.php?choosedAccount=enseignant&confirmChoix=true&currentSess=administrateur" class="connection-item">
                                                        <i class="zmdi zmdi-map txt-danger"></i>
                                                        <span syt class="block">Enseignant</span>
                                                    </a>
                                                </li>
                                                <?php
                                                break;
                                            case 'responsable_pedagogique':
                                                ?>
                                                <li>
                                                    <a href="<?php echo PATH_CONTROLEUR; ?>login/askAccountToConnect.php?choosedAccount=responsable_pedagogique&confirmChoix=true&currentSess=administrateur" class="connection-item">
                                                        <i class="zmdi zmdi-comment-outline txt-warning"></i>
                                                        <span class="block">Resp. Péd.</span>
                                                    </a>
                                                </li>
                                                <?php
                                                break;
                                        }
                                    }
                                }
                                 ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="app-box-bottom-wrap">
                            <hr class="light-grey-hr ma-0"/>
                            <a class="block text-center read-all" href="javascript:void(0)"> more </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown full-width-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-more-vert top-nav-icon"></i></a>
                <ul class="dropdown-menu mega-menu pa-0" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li class="product-nicescroll-bar row">
                        <ul class="pa-20">
                            <li class="col-md-3 col-xs-6 col-menu-list">
                                <a href="javascript:void(0);"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Projets</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                                <hr class="light-grey-hr ma-0"/>
                                <center>
                                    <a class="label label-primary" href="index.php?page=createProjet"><i class="fa fa-plus-circle"></i> Créer un projet</a>
                                </center>
                                <ul  style="background-color:#d0cdcd33;" >
                                    <li style="height:20px;"></li>
                                    <?php
                                    if($projs = $PROJET->getAll()){
                                        foreach ($projs as $proj => $value) {

                                            $lnk='index.php?page=loadProjet&id='.$value["projet_id"];
                                            ?>
                                            <li style='<?php if($value["projet_id"]==$PROJET->getId()){ echo "background-color:white;";$lnk= "";} ?>border:1px solid white'>
                                                <a href="<?php echo $lnk; ?>"><?php echo $value["projet_nom"]; ?> </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <li style="height:30px;"></li>
                                </ul>
                            </li>
                        </li>
                        <li class="col-md-3 col-xs-6 col-menu-list">
                            <a href="javascript:void(0);">
                                <div class="pull-left">
                                    <i class="fa fa-users"></i><span class="right-nav-text">Groupes</span>
                                </div>
                                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>

                                <div class="clearfix"></div>
                            </a>
                            <hr class="light-grey-hr ma-0"/>
                            <ul>
                                <li>
                                    <center>
                                        <a class="label label-primary" href="index.php?page=addGroupe"><i class="fa fa-plus-circle"></i> ajouter un groupe</a>
                                    </center>
                                </li>
                                <?php
                                if($grps=$PROJET->getGroupes()){
                                    foreach ($grps as $grp => $value) {
                                        ?>
                                        <li>
                                            <a href="index.php?page=showGroup&groupeId=<?php echo $value["groupe_id"]; ?>"><?php echo $value["groupe_specialite"]; ?></a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                            <li class="col-md-3 col-xs-6 col-menu-list">
                                <a href="javascript:void(0);"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Livrets</span></div>
                                    <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                                    <div class="clearfix"></div></a>
                                <hr class="light-grey-hr ma-0"/>
                                <ul>
                                    <?php
                                    require_once(PATH_MODEL."admin/showLivrets.php");
                                    $projet_id=$PROJET->getId();
                                    $livrets=showLivrets::getLivrets($projet_id);
                                    $filelocation=PATH_MODEL."livret-pdf/".$projet_id."/";
                                    for ($i=0;$i<count($livrets);$i++){
                                        ?>
                                        <li>
                                            <a href=<?php echo $filelocation.$livrets[$i]['livret_nom'].".pdf"?> onclick="window.open(this.href); return false;">
                                                <?php echo $livrets[$i]['livret_nom'].".pdf";?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown alert-drp">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i>
                    <?php
                        if($notifications = $PROJET->getNotifications()){
                            ?>
                            <span class="top-nav-icon-badge"><?php echo count($notifications); ?></span>
                            <?php
                        } ?>
                </a>
                <ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                    <li>
                        <div class="notification-box-head-wrap">
                            <span class="notification-box-head pull-left inline-block">notifications</span>
                            <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> Marquer tous comme lue </a>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr ma-0"/>
                        </div>
                    </li>
                    <li>
                        <div class="streamline message-nicescroll-bar">
                            <?php
                                if($notifications = $PROJET->getNotifications()){
                                    foreach ($notifications as $notifKey => $notifValue){ ?>
                                        <div class="sl-item">
                                            <a href="index.php?page=showSuggestion&suggesId=<?php echo $notifValue['suggestion_id']; ?>">
                                                <div title="<?php echo $notifValue['user_prenom'].' '.$notifValue['user_nom'].' - '.$notifValue['user_mail']; ?>" class="img-circle icon bg-green">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="sl-content">
                                                    <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                                                    <?php echo str_replace("_"," >> ",$notifValue["suggestion_cible"]); ?></span>
                                                    <div class="clearfix"></div>
                                                    <p class="truncate"><?php echo $notifValue["suggestion_valeur"]; ?></p>
                                                </div>
                                            </a>
                                        </div>
                                        <hr class="light-grey-hr ma-0"/><?php
                                    }
                                }else{
                                    echo center("Aucune notification");
                                } ?>
                        </div>
                    </li>
                    <li>
                        <div class="notification-box-bottom-wrap">
                            <hr class="light-grey-hr ma-0"/>
                            <a class="block text-center read-all" href="index.php?page=showSuggestion&suggesId=all"> Voire tous </a>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <script type="text/javascript">
        function changeProjectName(element){
            var fd = new FormData(document.getElementById("formProjetName"));
               fd.append("label", "WEBUPLOAD");
               $.ajax({
                 url: "index.php?page=assync.editProject",
                 type: "POST",
                 data: fd,
                 processData: false,
                 contentType: false
               }).done(function( data ) {
                   document.getElementById("notifChangedProjectName").innerHTML=data;
                   document.getElementById("notifChangedProjectName").style="font-size:11px;color:rgba(200,200,200);opacity:1;";
                   $("#notifChangedProjectName").fadeTo(1000,2).slideUp(200, function(){

                   });
               });
               return false;

        }
    </script>
</nav>
<!-- /Top Menu Items -->
