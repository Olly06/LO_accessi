<?php
	// Lepuri Orlando 5AI logout.php
	require_once 'funcDB.php';
	
	session_start();
	session_destroy();
	
	$lastID = $_SESSION['lastLogInID'];
	$query = "UPDATE accessi SET DataFine='" . date('Y-m-d') . "', OraFine='" . date('H:i:s') . "' WHERE idA=$lastID;";
	execUpdateOrDelete($query);
	
	header("Location: index.php");
?>