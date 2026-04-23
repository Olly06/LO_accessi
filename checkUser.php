<?php
	// Lepuri Orlando 5AI checkUser.php
	
	require_once 'func.php';
	
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && !empty($_POST)){
		$userForm = ["user" => $_POST['user'],
					"pwd" => $_POST['pwd'],
					"ruolo" => 2];
		$myUser = isValidUser($userForm);
		if($myUser != null){
			session_start();
			$_SESSION['idU'] = $myUser['idU'];
			$_SESSION['nome'] = $myUser['nome'];
			$_SESSION['cognome'] = $myUser['cognome'];
			$_SESSION['dataNascita'] = $myUser['dataNascita'];
			$_SESSION['sesso'] = $myUser['sesso'];
			$_SESSION['email'] = $myUser['email'];
			$_SESSION['telefono'] = $myUser['telefono'];
			$_SESSION['residenza'] = $myUser['residenza'];
			$_SESSION['ruolo'] = ($myUser['ruolo'] == '1') ? "admin" : "user";
			
			$sqlIns = "INSERT INTO accessi (DataInizio,OraInizio,idU) VALUES ('" . date('Y-m-d') . "','" . date('H:i:s') . "','" . $_SESSION['idU'] . "');";
			$_SESSION['lastLogInID'] = execInsert($sqlIns);
			
			$home = ($myUser['ruolo'] == 1) ? 'homeAdmin.php' : 'homeUser.php';
			header("Location: $home");
		}
		else{
			header("Location: login.php?errLog=true");
		}
	}
?>