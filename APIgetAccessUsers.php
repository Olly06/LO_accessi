<?php
	//Lepuri Orlando 5AI APIgetAccessUsers.php
	require_once 'func.php';	
	if(isset($_POST['idU'])){
		$idU = $_POST['idU'];
		$risServer = getAllAccessesFromUser($idU);
		if(count($risServer) == 0)
			$risServer = 'NoDataFound';
	}
	else
		$risServer = 'ERROR';
	
	echo json_encode($risServer);
?>