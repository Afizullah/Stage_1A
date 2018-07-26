<?php

class editUser extends DB{
	public static function getEmail($user_id){
		return DB::query("SELECT user_mail FROM utilisateurs WHERE user_id=$user_id")[0]['user_mail'];
	}
}
?>