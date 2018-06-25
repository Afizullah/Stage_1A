<?php

    class Group extends DB {
        public function createGroup($groupe_nom) {
            DB::registre("groupe",[["groupe_specialite",groupe_nom]]);
            header("Location : https://gitlab.com/esp_livret/livret");
        }
    }

?>