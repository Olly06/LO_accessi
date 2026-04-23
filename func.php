<?php
	// Lepuri Orlando 5AI func.php
	require_once 'funcDB.php';
	
	function isValidUser($user){
		$u = $user['user'];
		$p = $user['pwd'];
		$res = execSelect("SELECT * FROM utenti WHERE email='$u' AND password='$p';");
		return (count($res) == 1) ? $res[0] : null;
	}
	
	function getLastAccess($id){
		$res = execSelect("SELECT * FROM accessi WHERE idU='$id' ORDER BY DataInizio DESC, OraInizio DESC LIMIT 2;");
		return (count($res) == 2) ? $res[1] : ((count($res) == 1) ? $res[0] : null);
	}
	
	function getAllUsers(){
		$res = execSelect("SELECT idU, email FROM utenti ORDER BY email;");
		return $res;
	}
	
	function getAllAccessesFromUser($idU){
		$res = execSelect("SELECT * FROM accessi WHERE idU='$idU';");
		return $res;
	}
?>