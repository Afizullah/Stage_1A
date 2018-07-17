<?php
    require_once(PATH_MODEL."admin/addFormation.php");
    class EditFormation extends DB{
        public static function formationExiste($formationId){
            return DB::getLine("formation","formation_id",[["formation_id",intval($formationId)]]);
        }
        public static function deleteFormation($formationId){
            if(self::formationExiste($formationId)){
                return DB::execute("DELETE FROM formation WHERE formation_id=".intval($formationId));
            }
            return true;
        }


        public static function ueExiste($ueId){
            return DB::getLine("ue","ue_id",[["ue_id",intval($ueId)]]);
        }
        public static function deleteUe($ueId){
            if(self::ueExiste($ueId)){
                return DB::execute("DELETE FROM ue WHERE ue_id=".intval($ueId));
            }
            return true;
        }


        public static function ecExiste($ecId){
            return DB::getLine("ec","ec_id",[["ec_id",intval($ecId)]]);
        }
        public static function deleteEc($ecId){
            if(self::ecExiste($ecId)){
                return DB::execute("DELETE FROM ec WHERE ec_id=".intval($ecId));
            }
            return true;
        }
    }
?>
