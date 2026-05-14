<?php
	// Lepuri Orlando 5AI homeUser.php
	require 'func.php';
	
	session_start();
	if(empty($_SESSION['ruolo']) || $_SESSION['ruolo'] != 'user'){
		if(empty($_SESSION['ruolo']) || $_SESSION['ruolo'] != 'admin')
			header("Location: logout.php");
		else
			header("Location: homeAdmin.php");
	}
	else{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>HOME USER</title>
	</head>
	
	<body>
		<h1>HOME USER</h1>
		<?php
			echo "<p>Benvenuto/a " . $_SESSION['cognome'] . " " . $_SESSION['nome'] . "</p>";
			echo '<pre>';
			print_r($_SESSION);
			echo '</pre>';
			
			echo 'Ultimo accesso:<pre>';
			print_r(getLastAccess($_SESSION['idU']));
			echo '</pre>';
		?>
		<hr>
		<h2>I Miei Accessi</h2>
		<?php
			$mieiAccessi = getAllAccessesFromUser($_SESSION['idU']);
			if(count($mieiAccessi) > 0){
				echo "<table border='1'><tr><th>Data Inizio</th><th>Ora</th><th>Data Fine</th><th>Ora Fine</th></tr>";
				foreach($mieiAccessi as $acc){
					echo "<tr>
						<td>{$acc['DataInizio']}</td>
						<td>{$acc['OraInizio']}</td>
						<td>{$acc['DataFine']}</td>
						<td>{$acc['OraFine']}</td>
					</tr>";
				}
				echo "</table>";
			} else {
				echo "<p>Nessun accesso registrato.</p>";
			}
		?>
		<br>
		<a href="editProfile.php"><button>Modifica il mio Profilo</button></a>
		<br><br>
		<a href="logout.php"><button>LOGOUT</button></a>
		<br>
		<br>
	</body>
</html>
<?php
	}
?>