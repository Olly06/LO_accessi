<?php
	// Lepuri Orlando 5AI login.php
	session_start();

	if(!empty($_SESSION['ruolo']) && ($_SESSION['ruolo'] == 'admin' || $_SESSION['ruolo'] == 'user')){
		if($_SESSION['ruolo'] == 'admin')
			header("Location: homeAdmin.php");
		elseif($_SESSION['ruolo'] == 'user')
			header("Location: homeUser.php");
		else
			header("Location: logout.php");
	}
	else{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
	</head>
	
	<body>
		<h1>Pagina di Log-In</h1>
		<form method="POST" action="checkUser.php">
			Username: <input type="text" name="user" placeholder="User..." required>
			<br>
			Password: <input type="password" name="pwd" placeholder="Pwd..." required>
			<br>
			<input type="submit" name="login" value="ACCEDI">
		</form>
		<?php
			if(isset($_GET['errLog']) && $_GET['errLog'])
				echo "<p><b style=\"color:red;\"> Credenziali errate, ritenta l'accesso</b></p>";
	}
		?>
	</body>
</html>