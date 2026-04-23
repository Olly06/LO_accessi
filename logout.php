<?php
	// Lepuri Orlando 5AI logout.php
	require_once 'funcDB.php';
	
	session_start();
	session_destroy();
	
	$lastID = $_SESSION['lastLogInID'];
	$query = "UPDATE accessi SET DataFine=?, OraFine=? WHERE idA=?;";
	execUpdateOrDelete($query, [date('Y-m-d'), date('H:i:s'), $lastID]);
	
	header("Location: index.php");
?>