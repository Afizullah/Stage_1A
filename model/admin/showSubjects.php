<?php

    Class Subjects extends DB {
        function getSubjectsGroup($groupId) {
            return DB::query('SELECT ec_code, ec_nom, ec_competence, ec_prerequis FROM ec WHERE groupe_id ='.$groupId);
        }

        function getSubjects() {
            return DB::query('SELECT projet_id FROM ec WHERE groupe_id ='.$groupId);
        }
    }

?>