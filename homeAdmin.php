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


		
		
		<br><br>
		<h2>Cancella Accessi Utente (dopo una certa data)</h2>
		<form id='frmDeleteUserAccesses' onsubmit='removeUserAccessesAfterDate(); return false;'>
			Utente: 
			<select name='user' required>
				<option value=''>---</option>
			<?php
				$users = getAllUsers();
				foreach($users AS $a){
					echo "<option value='" . $a['idU'] . "'>" . $a['email'] . "</option>";
				}
			?>
			</select>
			<br><br>
			Elimina gli accessi successivi al: 
			<input type='date' name='dataLimite' required>
			<br><br>
			<input type='submit' value='Rimuovi Accessi Utente'>
		</form>
		<div id='risDeleteUserAccesses'></div>

		<hr>
		<h2>Modifica Dati di un Utente</h2>
		<form method="GET" action="editProfile.php">
			Utente: <select name="idU" required>
				<option value="">---</option>
			<?php
				foreach($users AS $a){
					echo "<option value='" . $a['idU'] . "'>" . $a['email'] . "</option>";
				}
			?>
			</select>
			<input type="submit" value="Modifica Profilo">
		</form>

		<hr>

		<h3>Ingressi compresi tra due date</h3>
		<form method="POST">
			Dal: <input type="date" name="dataDal" required> 
			Al: <input type="date" name="dataAl" required>
			<input type="submit" name="btnQueryI" value="Cerca">
		</form>
		<?php
			if(isset($_POST['btnQueryI'])){
				$resI = getAccessiTraDate($_POST['dataDal'], $_POST['dataAl']);
				if($resI){
					echo "<ul>";
					foreach($resI as $r) echo "<li>{$r['cognome']} {$r['nome']} - Inizio: {$r['DataInizio']} {$r['OraInizio']}</li>";
					echo "</ul>";
				} else echo "<p>Nessun risultato.</p>";
			}
		?>

		<h3>Accessi per ogni giorno</h3>
		<?php
			$resJ = getConteggioAccessiGiornalieri();
			if($resJ){
				echo "<table border='1'><tr><th>Data</th><th>Numero Accessi</th></tr>";
				foreach($resJ as $g) echo "<tr><td>{$g['DataInizio']}</td><td>{$g['NumeroAccessi']}</td></tr>";
				echo "</table>";
			}
		?>

		<h3>Utenti con più di N accessi in un mese</h3>
		<form method="POST">
			Min. Accessi (N): <input type="number" name="n_acc" required>
			Mese : <input type="number" name="mese" min="1" max="12" required>
			Anno: <input type="number" name="anno" required>
			<input type="submit" name="btnQueryK" value="Cerca">
		</form>
		<?php
			if(isset($_POST['btnQueryK'])){
				$resK = getUtentiFrequenti($_POST['n_acc'], $_POST['mese'], $_POST['anno']);
				if($resK){
					echo "<ul>";
					foreach($resK as $r) echo "<li>{$r['cognome']} {$r['nome']} - Totale accessi: {$r['TotaleAccessi']}</li>";
					echo "</ul>";
				} else echo "<p>Nessun utente soddisfa i criteri.</p>";
			}
		?>

		<h3>Utente con accesso di durata massima</h3>
		<?php
			$resL = getAccessoDurataMassima();
			if($resL && count($resL) > 0){
				$l = $resL[0];
				echo "<p>L'utente <b>{$l['cognome']} {$l['nome']}</b> ha effettuato l'accesso più lungo il {$l['DataInizio']} alle {$l['OraInizio']}. <br>Durata complessiva: <b>{$l['Durata']}</b></p>";
			}
		?>

		<hr>
		<a href="logout.php"><button>LOGOUT</button></a>
		<br>
		<br>
	</body>
</html>
<?php
	}
?>