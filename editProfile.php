<?php
// Lepuri Orlando 5AI editProfile.php
require_once 'func.php';
session_start();

if(empty($_SESSION['ruolo'])){
    header("Location: login.php");
    exit;
}

$idDaModificare = $_SESSION['idU'];
if($_SESSION['ruolo'] == 'admin' && !empty($_GET['idU'])){
    $idDaModificare = $_GET['idU'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aggiorna'])){
    if(updateUser($_POST['idU_edit'], $_POST['nome'], $_POST['cognome'], $_POST['telefono'], $_POST['residenza'])){
        $msg = "<p style='color:green;'>Profilo aggiornato con successo!</p>";
    } else {
        $msg = "<p style='color:red;'>Errore durante l'aggiornamento.</p>";
    }
}

$datiAttuali = execSelect("SELECT * FROM utenti WHERE idU=?", [$idDaModificare]);
$u = $datiAttuali[0];
?>
<!DOCTYPE html>
<html>
    <head><title>Modifica Profilo</title></head>
    <body>
        <h2>Modifica Dati</h2>
        <?php if(isset($msg)) echo $msg; ?>
        
        <form method="POST" action="editProfile.php<?php echo isset($_GET['idU']) ? '?idU='.$_GET['idU'] : ''; ?>">
            <input type="hidden" name="idU_edit" value="<?php echo $u['idU']; ?>">
            
            Nome: <br><input type="text" name="nome" value="<?php echo htmlspecialchars($u['nome']); ?>" required><br><br>
            Cognome: <br><input type="text" name="cognome" value="<?php echo htmlspecialchars($u['cognome']); ?>" required><br><br>
            Telefono: <br><input type="text" name="telefono" value="<?php echo htmlspecialchars($u['telefono']); ?>" required><br><br>
            Residenza: <br><input type="text" name="residenza" value="<?php echo htmlspecialchars($u['residenza']); ?>" required><br><br>
            
            <input type="submit" name="aggiorna" value="Salva Modifiche">
        </form>
        <br>
        <a href="<?php echo $_SESSION['ruolo'] == 'admin' ? 'homeAdmin.php' : 'homeUser.php'; ?>"><button>Torna alla Home</button></a>
    </body>
</html>