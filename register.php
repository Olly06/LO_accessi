<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pagina di Registrazione</title>
</head>
<body>

    <h2>Registrazione</h2>
    
    <form action="register" method="POST">
        
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome" required><br><br>

        <label for="dataNascita">Data di Nascita:</label><br>
        <input type="date" id="dataNascita" name="dataNascita" required><br><br>

        <label for="sesso">Sesso:</label><br>
        <select id="sesso" name="sesso" required>
            <option value="" disabled selected>Seleziona...</option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="telefono">Telefono:</label><br>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <label for="residenza">Residenza:</label><br>
        <input type="text" id="residenza" name="residenza" required><br><br>

        <button type="submit">Registrati</button>

    </form>

</body>
</html>