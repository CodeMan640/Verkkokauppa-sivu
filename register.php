<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Rekisteröidy</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>
    <?php require 'navigation.php'?>
    
    <form method="post" action="register2.php">
        
        <label for="email">Sähköposti:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Salasana:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Rekisteröidy</button>
    </form>

    <footer>
        <div class="footer-content">
            <p>© 2024 Tuottajamarket. All rights reserved.</p>
            <p>Jesse Lipponen</p>
            <p>Savon ammattiopisto</p>
        </div>
    </footer>
</body>
</html>
