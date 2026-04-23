<?php
	// Lepuri Orlando homeUser.php
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
		<a href="logout.php"><button>LOGOUT</button></a>
		<br>
		<br>
	</body>
</html>
<?php
	}
?>