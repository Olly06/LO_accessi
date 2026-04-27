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
        <label>Email:</label><br>
        <input type="email" name="user" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="pwd" required><br><br>
			<br>
			<input type="submit" name="login" value="ACCEDI">
		</form><br>
		<a href="register.php"><button>Registrati</button></a>
		<?php
			if(isset($_GET['errLog']) && $_GET['errLog'])
				echo "<p><b style=\"color:red;\"> Credenziali errate, ritenta l'accesso</b></p>";
	}
		?>	
	</body>
</html>