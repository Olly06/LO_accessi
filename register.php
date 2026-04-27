<?php
require_once 'funcDB.php';

$messaggio = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $dataNascita = $_POST['dataNascita'];
    $sesso = $_POST['sesso'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $residenza = $_POST['residenza'];
    $ruolo = 2;

    $sqlIns = "INSERT INTO utenti (nome, cognome, dataNascita, sesso, email, password, telefono, residenza, ruolo) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    
    $params = [$nome, $cognome, $dataNascita, $sesso, $email, $password, $telefono, $residenza, $ruolo];

    $nuovoUtenteID = execInsert($sqlIns, $params);

    if ($nuovoUtenteID != null) {
        header("Location: login.php");
        exit;
    } else {
        $messaggio = "<p style='color:red;'>Errore nella registrazione</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione Utente</title>
</head>
<body>

    <h2>Crea un nuovo account</h2>

    <?php echo $messaggio; ?>

    <form action="register.php" method="POST">
        
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Cognome:</label><br>
        <input type="text" name="cognome" required><br><br>

        <label>Data di Nascita:</label><br>
        <input type="date" name="dataNascita" required><br><br>

        <label>Sesso:</label><br>
        <select name="sesso" required>
            <option value="M">M</option>
            <option value="F">F</option>
        </select><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Telefono:</label><br>
        <input type="tel" name="telefono" required><br><br>

        <label>Residenza:</label><br>
        <input type="text" name="residenza" required><br><br>

        <button type="submit">Registrati</button>

    </form>

    <p>Hai già un account? <a href="login.php">Accedi qui</a></p>

</body>
</html>