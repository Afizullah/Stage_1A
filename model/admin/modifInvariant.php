<?php

    Class Invariant extends DB {
        public static function getInvariant($projetId) {
            return DB::query("SELECT projet_invariant.invariant_id, invariant.invariant_id, invariant.invariant_nom, invariant.invariant_contenu FROM invariant
                              INNER JOIN projet_invariant ON invariant.invariant_id=projet_invariant.invariant_id
                              WHERE projet_invariant.projet_id=".$projetId."
                              ");
        }

        public static function recordModif($invariantId,$invariantContent) {
            return DB::update("invariant",[["invariant_contenu",$invariantContent]],[["invariant_id",$invariantId]]);
        }
    }

?>
