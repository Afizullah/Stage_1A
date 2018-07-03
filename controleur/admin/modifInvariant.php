<?php
    
    if (isset($_POST['modifInvariant'])) {
        $invariantId = $_POST['invariantId'];
        $invariantContent = $_POST['invariantContent'];
        for($i=0; $i<count($invariantContent);$i++) {
            Invariant::recordModif($invariantId[$i],$invariantContent[$i]);
        }
    }

?>
