<?php

require_once(PATH_CONTROLEUR."commun.user.php");

function linkCreatProjet(){
    ?>
    <li>
        <a href="index.php?page=createProjet">Créer un projet</a>
    </li>
    <?php
}
 ?>

<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">

            <!-- User Profile -->
            <li>
                <div class="user-profile text-center">
                    <img src="https://hencework.com/theme/grandin-demo/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/>
                    <div class="dropdown mt-5">
                    <a href="#" class="dropdown-toggle pr-0 bg-transparent" data-toggle="dropdown"><?php echo CurrentUser::getFullName(); ?><span class="caret"></span></a>
                    <?php
                        getMenuUser();
                    ?>
                    </div>
                </div>
            </li>
            <!-- /User Profile -->
            <li class="navigation-header">
                <span>Utilisateurs</span>
                <i class="zmdi zmdi-more"></i>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr1"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gérer les comptes</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                <ul id="dashboard_dr1" class="collapse collapse-level-1">
                    <li>
                        <a href="index.php?page=addUser">Créer un compte</a>
                    </li>
                    <li>
                        <a href="index.php?page=showUsers">Liste des comptes</a>
                    </li>
                </ul>

            </li>

        <li class="navigation-header">
            <span>Projets</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Projets</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="dashboard_dr" class="collapse collapse-level-1">
                <li>
                    <a href="index.php?page=createProjet"><i class="fa fa-plus-circle"></i> Nouveau</a>
                </li>
                <li>
                    <a href="index.php?page=showProjets">Liste des projets</a>
                </li>
            </ul>

        </li>

        <li class="navigation-header">
            <span>Formations</span>
            <i class="zmdi zmdi-more"></i>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr2"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Formations</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>

            <ul id="dashboard_dr2" class="collapse collapse-level-1">
            <?php
            if($loaded = $PROJET->projetLoaded()){
                ?>
                    <li>
                        <a href="index.php?page=addFormation"><i class="fa fa-plus-circle"></i> Ajouter</a>
                    </li>
                    <?php
                    if($PROJET->getFormations()){ ?>
                        <li>
                            <a href="index.php?page=showFormations&projetId=<?php echo $PROJET->getId(); ?>">Liste des formations</a>
                        </li>
                        <?php
                    }
            }else{
                linkCreatProjet();
            }

            ?>
        </ul>

        </li>


        <!--<li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Apps </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="app_dr" class="collapse collapse-level-1">
                <li>
                    <a href="chats.html">chats</a>
                </li>
                <li>
                    <a href="calendar.html">calendar</a>
                </li>
                <li>
                    <a href="weather.html">weather</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#email_dr">Email<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="email_dr" class="collapse collapse-level-2">
                        <li>
                            <a href="inbox.html">inbox</a>
                        </li>
                        <li>
                            <a href="inbox-detail.html">detail email</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#contact_dr">Contacts<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="contact_dr" class="collapse collapse-level-2">
                        <li>
                            <a href="contact-list.html">list</a>
                        </li>
                        <li>
                            <a href="contact-card.html">cards</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="file-manager.html">File Manager</a>
                </li>
                <li>
                    <a href="todo-tasklist.html">To Do/Tasklist</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="widgets.html"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">widgets</span></div><div class="pull-right"><span class="label label-warning">8</span></div><div class="clearfix"></div></a>
        </li>
    -->
        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
            <span>Groupes <a href="index.php?page=addGroupe"  ><i style="color:white;font-size:15px" class="fa fa-plus-circle"></i></a></span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <?php
        if($loaded){

            if($grps = $PROJET->getGroupes()){
                $num = 1;
                foreach ($grps as $grp => $value) {
                    ?>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr<?php echo $num; ?>"><div class="pull-left"><i class="zmdi zmdi-smartphone-setup mr-20"></i><span class="right-nav-text"><?php echo $value["groupe_specialite"]; ?></span></div><div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div>
                        </a>
                        <ul id="ui_dr<?php echo $num; ?>" class="collapse collapse-level-1 two-col-list">
                            <li>
                                <a href="modals.html">Matières</a>
                            </li>
                            <li>
                                <a href="panels-wells.html">Participants</a>
                            </li>
                            <li>
                                <a href="notifications.html">Propositions</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
            }
        }else{
            linkCreatProjet();
        }
         ?>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
            <span>Livrets</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_dr"><div class="pull-left"><i class="zmdi zmdi-google-pages mr-20"></i><span class="right-nav-text">Special Pages</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="pages_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="active-page" href="blank.html">Blank Page</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#auth_dr">Auth pages<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="auth_dr" class="collapse collapse-level-2">
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="signup.html">Register</a>
                        </li>
                        <li>
                            <a href="forgot-password.html">Recover Password</a>
                        </li>
                        <li>
                            <a href="reset-password.html">reset Password</a>
                        </li>
                        <li>
                            <a href="locked.html">Lock Screen</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#invoice_dr">Invoice<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="invoice_dr" class="collapse collapse-level-2">
                        <li>
                            <a href="invoice.html">Invoice</a>
                        </li>
                        <li>
                            <a href="invoice-archive.html">Invoice Archive</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#error_dr">error pages<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="error_dr" class="collapse collapse-level-2">
                        <li>
                            <a href="404.html">Error 404</a>
                        </li>
                        <li>
                            <a href="500.html">Error 500</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="gallery.html">Gallery</a>
                </li>
                <li>
                    <a href="timeline.html">Timeline</a>
                </li>
                <li>
                    <a href="faq.html">FAQ</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="documentation.html"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text">documentation</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dropdown_dr_lv1"><div class="pull-left"><i class="zmdi zmdi-filter-list mr-20"></i><span class="right-nav-text">multilevel</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="dropdown_dr_lv1" class="collapse collapse-level-1">
                <li>
                    <a href="#">Item level 1</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#dropdown_dr_lv2">Dropdown level 2<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="dropdown_dr_lv2" class="collapse collapse-level-2">
                        <li>
                            <a href="#">Item level 2</a>
                        </li>
                        <li>
                            <a href="#">Item level 2</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->
