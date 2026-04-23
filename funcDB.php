<?php
	//Lepuri Orlando funcDB.php
	function connDB(){
		$host = 'localhost';
		$db = 'lo_accessi';
		$user = 'root';
		$pwd = '';
		$conn = null;
		try{
			$conn = new PDO("mysql:dbname=$db;host=$host", $user, $pwd);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			$conn = null;
		}
		
		return $conn;
	}
	function execSelect($q, $params = []) {
    $result = null;
    $conn = connDB();
    if($conn != null){
        try{
            $stmt = $conn->prepare($q);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){ $result = null; }
    }
    return $result;
}

function execInsert($q, $params = []) {
    $result = null;
    $conn = connDB();
    if($conn != null){
        try{
            $stmt = $conn->prepare($q);
            $stmt->execute($params);
            $result = $conn->lastInsertId();
        } catch(PDOException $e){ $result = null; }
    }
    return $result;
}
	
	function execUpdateOrDelete($q){
		$result = null;
		$conn = connDB();
		
		if($conn != null){
			try{
				$stmt = $conn->prepare($q);
				$stmt -> execute();
				
				$result = $stmt -> rowCount();
			}
			catch(PDOException $e){
				$result = null;
			}
		}
		
		return $result;
	}
	
?>