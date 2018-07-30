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
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr1"><div class="pull-left"><i class="fa fa-user"></i><span class="right-nav-text">Gérer les comptes</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                <ul id="dashboard_dr1" class="collapse collapse-level-1">
                    <li>
                        <a href="index.php?page=addUser"><i class="fa fa-plus-circle"></i> Nouveau</a>
                    </li>
                    <li>
                        <a href="index.php?page=showUsers"><i class="fa fa-list"></i> Liste</a>
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
                    <a href="index.php?page=showProjets"><i class="fa fa-list"></i> Liste</a>
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
                        <a href="index.php?page=importFormation"><i class="fa fa-download"></i> Importer</a>
                    </li>
                    <?php
                    if($PROJET->getFormations()){ ?>
                        <li>
                            <a href="index.php?page=editFormation"><i class="fa fa-edit"></i> Modifier</a>
                        </li>
                        <li>
                            <a href="index.php?page=choixexportFormation"><i class="fa fa-upload"></i> Exporter</a>
                        </li>
                        <?php
                    }
            }else{
                linkCreatProjet();
            }

            ?>
        </ul>

        </li>


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
                                <a href="index.php?page=showUsers#enseignant">Participants</a>
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
        <li>
            <a href="index.php?page=genererLivret">Générer un livret</a>
        </li>
        <li>
            <a href="index.php?page=showLivrets">Afficher les livrets</a>
        </li>
        <li>&nbsp</li>
        <li>&nbsp</li>
        <li>&nbsp</li>
        <li>&nbsp</li>

    </ul>
    <br /><br /><br />
</div>
<!-- /Left Sidebar Menu -->
