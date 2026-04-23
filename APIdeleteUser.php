<?php
	//Lepuri Orlando 5AI APIdeleteUser.php
	require_once 'func.php';	
	if(isset($_POST['idU'])){
		$idU = $_POST['idU'];
		$risServer = deleteUser($idU);
		if($risServer == null)
			$risServer = 'NoDataFound';
	}
	else
		$risServer = 'ERROR';
	
	echo "$risServer";
?>