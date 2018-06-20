<?php
require_once(PATH_MODEL."commun/DataObject.class.php");
class DB extends DataObject{

    public static function query($req){
        $bdd = parent::connect();
        if($query = $bdd->query($req)){
          return $query->fetchAll(PDO::FETCH_ASSOC);}
        return false;
    }
    public static function execute($req){
        $bdd = parent::connect();
        if($query = $bdd->exec($req))
          return $query;
        return false;
    }

    //DB::registre("utilisateurs",[["prenom",$prenom],["nom",$nom]]);
    public static function  registre($table,$tabRegisted){
        $bdd = parent::connect();
      	$nbrChamp = count($tabRegisted);
      	$realValues = array();
      	$str_insert_column  = "(";
      	$str_values = " VALUES (";
      	$sep = " ";
      	for ($i = 0; $i < $nbrChamp ; $i++)
      	{
      		$str_insert_column .= $sep.trim($tabRegisted[$i][0]);
      		$str_values .= $sep.":valeur".$i;
      		$realValues[":valeur".$i] = $tabRegisted[$i][1];
      		$sep = ",";
      	}
      	$str_values .= " )";
      	$str_insert_column .= " )";

      	$req = $bdd->prepare("INSERT INTO ".$table." ".$str_insert_column.$str_values);

      	if($req->execute($realValues)){
      		return $bdd->lastInsertId();
      	}else{
      		return 0;
      	}
      }
      //DB::getLine("utilisateurs","prenom,nom",[["user_email",$email],["user_mdpasse",$motdepasse]]);
      /*
       * @return boolean
      */
      public static function getLine($table,$champ="*",$tabData=[[1,1]],$operators=array(),$ordre="",$all=false,$op=" AND "){
        $bdd = parent::connect();
        $str_req = "";
        $tempVal = array();
        $sep = '';
        for($i=0;$i< count($tabData);$i++) {
          if(count($tabData[$i]==2)){
            if($i+1 > count($operators)){
              $tempOp = "=";
            }else{
              if(isOperator($operators[$i])){
                $tempOp = $operators[$i];
              }else{
                 die("Operateur non pris en charge !!!");
              }
            }
            $str_req .= $sep.$tabData[$i][0]." ".$tempOp." :valeur$i ";
            $tempVal["valeur$i"] = $tabData[$i][1];
            $sep = $op;
          }else{
            die("Tableau incorrect: <br/>
              SYNTAXE : [[champ1,donnee1],[champ2,donnee2],...] !!!");
          }
        }
        //Execution de la requette
        $requete = $bdd->prepare("SELECT {$champ} FROM {$table} WHERE ".$str_req." ".$ordre);
        if($requete->execute($tempVal)){
          if($all)
            $Infos = $requete->fetchAll(PDO::FETCH_ASSOC);
          else
            $Infos = $requete->fetch(PDO::FETCH_ASSOC);
          if($Infos)
            return $Infos;
          return false;

        }
      }
      //DB::getData("ec","*",[["ue_id",$ue_id]]);
      public static function getData($table,$champ="*",$tabData=[[1,1]],$operators=array(),$ordre="",$all=false,$op=" AND "){
        return self::getLine($table,$champ,$tabData,$operators,$ordre,true,$op);
      }

}

 ?>
