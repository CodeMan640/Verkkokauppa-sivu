<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Kirjautuminen</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>
    <?php require 'navigation.php'?>
    
    <div class="form-container">
    <form method="post" action="login2.php">
    <label for="email">Sähköposti:</label>
    <input type="text" id="email" name="email" required>
    
    <label for="password">Salasana:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
</form>

<p>Eikö ole tiliä? <a href="register.php">Rekisteröidy</a></p>
</div>
    <footer>
    <div class="footer-content">
        <p>© 2024 Tuottajamarket. All rights reserved.</p>
        <p>Jesse Lipponen</p>
        <p>Savon ammattiopisto</p>
    </div>
</footer>
</body>
</html>