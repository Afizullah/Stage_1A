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
                    <img src="<?php echo ADMIN_LOGO; ?>" alt="user_auth" class="user-auth-img img-circle"/>
                    <div class="dropdown mt-5">
                    <a href="#" class="dropdown-toggle pr-0 bg-transparent" data-toggle="dropdown"><?php echo CurrentUser::getFullName(); ?><span class="caret"></span></a>
                    <?php
                        getMenuUser(CurrentUser::getId());
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
                                <a href="index.php?page=showSubjects&groupId=<?php echo $value['groupe_id']; ?>">Matières</a>
                            </li>
                            <li>
                                <a href="index.php?page=showParticipants&groupId=<?php echo $value['groupe_id']; ?>">Participants</a>
                            </li>
                            <li>
                                <a href="">Propositions</a>
                            </li>
                        </ul>
                    </li>
                    <?php $num++;
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
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr3"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gérer les livrets</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                <ul id="dashboard_dr3" class="collapse collapse-level-1">
                    <li>
                        <a href="index.php?page=modifInvariant">Gérer les invariants</a>
                    </li>
                </ul>

            </li>
        <li>&nbsp</li>
        <li>&nbsp</li>
        <li>&nbsp</li>
        <li>&nbsp</li>

    </ul>
    <br /><br /><br />
</div>
<!-- /Left Sidebar Menu -->
