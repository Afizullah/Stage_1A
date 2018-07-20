<?php
require_once(PATH_CONTROLEUR . "admin/initFormation.file.class.php");
require_once(PATH_CONTROLEUR . "admin/initFormation.projet.class.php");
require_once(PATH_CONTROLEUR . "admin/initFormation.class.php");
function secureAll(&$tab)
{
    for ($i = 0; $i < count($tab); $i++) {
        $tab[$i] = secure($tab[$i]);
    }
}

function hasSameSize($tabs)
{
    $initSize = count($tabs[0]);
    for ($i = 0; $i < count($tabs); $i++) {
        if (count($tabs[$i]) != $initSize) {
            return false;
        }
    }
    return true;
}

function hasEmptyValue($tab)
{
    for ($i = 0; $i < count($tab); $i++) {
        if (empty($tab[$i])) {
            return true;
        }
    }
    return false;
}

if (isset($_POST["addFormations"])) {
    /*
    foreach ($_POST as $post) {

        var_dump($post,"<hr />");
    }
    die();
    */
    var_dump($_SESSION);
    die();

    if (isset($_POST["formations_noms"], $_POST["formations_code"], $_POST["formations_semestre"])) {
        $projetId = $PROJET->getId();
        $formationsNom = $_POST["formations_noms"];
        $formationsCode = $_POST["formations_code"];
        $formationsSem = $_POST["formations_semestre"];
        secureAll($formationsNom);
        secureAll($formationsCode);
        secureAll($formationsSem);
        if (!hasSameSize([$formationsNom, $formationsCode, $formationsSem])) {
            $errors[] = "Formulaire corrompu !!!";
        }
        if (hasEmptyValue($formationsNom) || hasEmptyValue($formationsCode)) {
            $errors[] = "Le nom ou le code d'aucune formation ne peut être vide";
        }
        if (!isset($errors)) {
            for ($form = 0; $form < count($formationsCode); $form++) {
                $thisInfosFormation = Formation::addFormation($projetId, $formationsCode[$form], $formationsNom[$form], $formationsSem[$form]);
                if ($regForm = $thisInfosFormation["registed"]) {
                    $thisFormationId = $thisInfosFormation["formationId"];
                    $classesFormNom = $_POST["class_" . $form];

                    secureAll($classesFormNom);
                    for ($cls = 0; $cls < count($classesFormNom); $cls++) {

                        $classeName = $classesFormNom[$cls];
                        $thisInfosClasse = Formation::addClasse($thisFormationId, $classeName);
                        $thisClassId = $thisInfosClasse["classeId"];
                        $sem = 0;
                        while (isset($_POST["ues_code_semestre" . $form . $cls . $sem])) {
                            echo $classesFormNom[$cls] . "(" . $sem . ")";
                            br();
                            $uesCode = $_POST["ues_code_semestre" . $form . $cls . $sem];
                            $uesCls = $_POST["ues_classe_semestre" . $form . $cls . $sem];
                            var_dump($uesCode);
                            br();
                            //var_dump($uesCls,$uesCode,"<hr />");br();br();br();
                            $sem++;
                        }
                        if ($thisInfosClasse["msg"]) {
                            $warning[] = $thisInfosFormation["msg"];
                        }

                    }
                    br();
                    br();
                    br();
                    if ($thisInfosFormation["msg"]) {
                        $warning[] = $thisInfosFormation["msg"];
                    }
                } else {
                    $errors[] = $thisInfosFormation["msg"];
                }
            }
            if (!isset($errors)) {
                $success = "Fichier enregisté avec succès";
            }
            die();
        }
    }
} else if (isset($_POST["formAddFormation"])) {
    $errors[] = "Le fichier est peut-être trop volumineux !<br /><b style='font-weight:bold'>ERROR:: php.ini</b> <br />Assurez-vous que <b style='font-weight:bold'>max_input_vars</b> est au moins > 3000 <br />";
}
?>
