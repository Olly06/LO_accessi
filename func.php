<?php
	// Lepuri Orlando 5AI func.php
	require_once 'funcDB.php';
	
	
	function isValidUser($user){
		$u = $user['user'];
		$p = $user['pwd'];
		$res = execSelect("SELECT * FROM utenti WHERE email=? AND password=?;", [$u, $p]);
		return (count($res) == 1) ? $res[0] : null;
	}

	function getAllAccessesFromUser($idU){
		$res = execSelect("SELECT * FROM accessi WHERE idU=?;", [$idU]);
		return $res;
	}
	
	function getLastAccess($id){
		$res = execSelect("SELECT * FROM accessi WHERE idU='$id' ORDER BY DataInizio DESC, OraInizio DESC LIMIT 2;");
		return (count($res) == 2) ? $res[1] : ((count($res) == 1) ? $res[0] : null);
	}
	
	function getAllUsers(){
		$res = execSelect("SELECT idU, email FROM utenti ORDER BY email;");
		return $res;
	}

	function deleteUser($id){
		$res = execUpdateOrDelete("DELETE FROM utenti WHERE idU='$id'");
		return $res;
	}

	function deleteUserAccessesAfterDate($idU, $dataLimite){
    $res = execUpdateOrDelete("DELETE FROM accessi WHERE idU='$idU' AND DataInizio <= '$dataLimite'");
    return $res;
}
	function updateUser($idU, $nome, $cognome, $telefono, $residenza) {
		$conn = connDB();
		if($conn != null){
			try{
				$stmt = $conn->prepare("UPDATE utenti SET nome=?, cognome=?, telefono=?, residenza=? WHERE idU=?");
				$stmt->execute([$nome, $cognome, $telefono, $residenza, $idU]);
				return true;
			} catch(PDOException $e){ 
				return false; 
			}
		}
		return false;
	}
	function getAccessiTraDate($dataInizio, $dataFine) {
		$res = execSelect("SELECT u.nome, u.cognome, a.DataInizio, a.OraInizio, a.DataFine, a.OraFine FROM accessi a JOIN utenti u ON a.idU = u.idU WHERE a.DataInizio BETWEEN ? AND ?", [$dataInizio, $dataFine]);
		return $res;
	}

	function getConteggioAccessiGiornalieri() {
		$res = execSelect( "SELECT DataInizio, COUNT(idA) as NumeroAccessi FROM accessi  GROUP BY DataInizio ORDER BY DataInizio DESC");
		return $res;
	}

	function getUtentiFrequenti($n, $mese, $anno) {
		$res = execSelect( "SELECT u.nome, u.cognome, COUNT(a.idA) as TotaleAccessi FROM utenti u JOIN accessi a ON u.idU = a.idU WHERE MONTH(a.DataInizio) = ? AND YEAR(a.DataInizio) = ? GROUP BY u.idU  HAVING TotaleAccessi > ? ORDER BY u.cognome ASC, u.nome ASC", [$mese, $anno, $n]);
		return $res;
	}

	function getAccessoDurataMassima() {
		$res = execSelect( "SELECT u.nome, u.cognome, a.DataInizio, a.OraInizio, TIMEDIFF(CONCAT(a.DataFine, ' ', a.OraFine), CONCAT(a.DataInizio, ' ', a.OraInizio)) as Durata FROM accessi a JOIN utenti u ON a.idU = u.idU WHERE a.DataFine IS NOT NULL AND a.OraFine IS NOT NULL ORDER BY Durata DESC  LIMIT 1");
		return $res;
	}
?>

