<?php 
class editUser extends DB{
	public static function get_current_mdp($user_id){
		 return DB::query("SELECT user_mdpasse FROM utilisateurs WHERE user_id=$user_id");
	}
	public static function update_mdp($mdp,$user_id){
		DB::update("utilisateurs",[["user_mdpasse",$mdp]],[["user_id",$user_id]]);
	}
	public static function update_email($email,$user_id){
		DB::update("utilisateurs",[["user_mail",$email]],[["user_id",$user_id]]);
	}

	public static function create_token($user_id,$token){
		DB::update("utilisateurs",[["user_token",$token]],[["user_id",$user_id]]);
	}
	public static function delete_token($user_id){
		DB::update("utilisateurs",[["user_token",NULL]],[["user_id",$user_id]]);
	}
	public static function get_token($user_id){
		return DB::query("SELECT user_token FROM utilisateurs WHERE user_id=$user_id")[0]["user_token"];
	}
}