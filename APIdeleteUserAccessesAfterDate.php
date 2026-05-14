<?php
	// Lepuri Orlando 5AI APIdeleteUserAccessesAfterDate.php
	require_once 'func.php';	
	
	if(isset($_POST['idU']) && isset($_POST['dataLimite'])){
		$idU = $_POST['idU'];
		$dataLimite = $_POST['dataLimite'];
		
		if(empty($idU) || empty($dataLimite)) {
			$risServer = 'Selezionare utente e data validi.';
		} else {
			$righeEliminate = deleteUserAccessesAfterDate($idU, $dataLimite);
			
			if($righeEliminate === null) {
				$risServer = 'Errore durante l\'eliminazione nel database.';
			} else {
				$risServer = "Operazione completata. Sono stati eliminati $righeEliminate accessi precedenti al $dataLimite per l'utente selezionato.";
			}
		}
	} else {
		$risServer = 'ERROR: Dati mancanti';
	}
	
	echo json_encode($risServer);
?>