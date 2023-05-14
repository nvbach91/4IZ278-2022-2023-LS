<!DOCTYPE html>
<html>
<head>
    <title>Přihlášení</title>
</head>
<body>
    <h1>Přihlášení</h1>
    <form method="post" action="/login">
        <label for="username">Uživatelské jméno</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Heslo</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Přihlásit se">
    </form>
    <p>Ještě nemáte účet? <a href="/register">Registrovat se</a></p>
</body>
</html>