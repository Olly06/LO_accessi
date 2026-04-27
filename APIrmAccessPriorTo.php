<?php
	//Lepuri Orlando 5AI APIrmAccessPriorTo.php
	require_once 'func.php';	
	if(isset($_POST['idU'])){
		$idU = $_POST['idU'];
		$risServer = rmAccesspriorTo($id, $date);
		if($risServer == null)
			$risServer = 'NoDataFound';
	}
	else
		$risServer = 'ERROR';
	
	echo "$risServer";
?>