<?php
	// Lepuri Orlando 5AI homeAdmin.php
	require 'func.php';
	
	session_start();

	if(empty($_SESSION['ruolo']) || $_SESSION['ruolo'] != 'admin'){
		if(empty($_SESSION['ruolo']) || $_SESSION['ruolo'] != 'user')
			header("Location: logout.php");
		else
			header("Location: homeUser.php");
	}
	else{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>HOME ADMIN</title>
		<script src='script.js'></script>
	</head>
	
	<body>
		<h1>HOME ADMIN</h1>
		<?php
			echo "<p>Benvenuto/a " . $_SESSION['cognome'] . " " . $_SESSION['nome'] . "</p>";
			echo '<pre>';
			print_r($_SESSION);
			echo '</pre>';
			
			echo 'Ultimo accesso:<pre>';
			print_r(getLastAccess($_SESSION['idU']));
			echo '</pre>';
		?>
		<h2>Visualizza Accessi</h2>
		<form id='frmUser' onsubmit='clearDIV(); return false;'>
			Utente: <select name='user' onchange='getAccesses()'>
						<option value=''>---</option>
			<?php
				$users = getAllUsers();
				foreach($users AS $a){
					echo "<option value='" . $a['idU'] . "'>" . $a['email'] . "</option>";
				}
			?>
			</select>
			<input type='submit' value='Clear'>
		</form>
		<div id='ris'></div>




		<h2>Cancella Utenti</h2>
		<form id='frmDelete' onsubmit='removeUser(); return false;'>
			Utente: <select name='user'>
						<option value=''>---</option>
			<?php
				$users = getAllUsers();
				foreach($users AS $a){
					echo "<option value='" . $a['idU'] . "'>" . $a['email'] . "</option>";
				}
			?>
			</select>
			<input type='submit' value='Rimuovi Utente'>
		</form>
		<div id='risDelete'></div>


		
		
		<h2>Cancella Accessi prima di Data</h2>
		<form id='frmAccess' onsubmit='removeAccessPriorTo(); return false;'>
			Utente: 
			<select name='user'>
				<option value=''>---</option>
					<?php
						$users = getAllUsers();
						foreach($users AS $a){
							echo "<option value='" . $a['idU'] . "'>" . $a['email'] . "</option>";
						}
					?>
			</select>
			<input type="date" value="date">
			<input type='submit' value='Rimuovi Accessi'>
		</form>
		<div id='risDelAccess'></div>

		<hr>
		<a href="logout.php"><button>LOGOUT</button></a>
		<br>
		<br>
	</body>
</html>
<?php
	}
?>