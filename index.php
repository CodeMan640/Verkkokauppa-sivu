<!DOCTYPE html>
<html>
<head>
    <?php require 'session_start.php'; ?> <!-- Varmistaa, että istunto on aloitettu -->
    <?php require_once 'navigation.php'; ?> <!-- Sisällytä navigointi -->
    <?php require 'header.php'; ?> <!-- Sisällytä header -->

    <link rel="stylesheet" href="css/style.css">
    <meta charset='utf-8'>
    <title>Etusivu</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>

    <!-- Näytä kirjautumisilmoitus, jos asetettu -->
    <?php if(isset($_SESSION['login_success'])): ?>
        <div id="login-notification" class="notification">
            Kirjautuminen onnistui!
        </div>
        <?php unset($_SESSION['login_success']); // Poista ilmoitus näyttämisen jälkeen ?>
    <?php endif; ?>
    
    <!-- Näytä uloskirjautumisilmoitus, jos asetettu -->
    <?php if(isset($_SESSION['logout_success'])): ?>
        <div id="logout-notification" class="notification">
            Olet kirjautunut ulos onnistuneesti.
        </div>
        <?php unset($_SESSION['logout_success']); // Poista ilmoitus näyttämisen jälkeen ?>
    <?php endif; ?>




    <footer>
        <div class="footer-content">
            <p>© 2024 Tuottajamarket. All rights reserved.</p>
            <p>Jesse Lipponen</p>
            <p>Savon ammattiopisto</p>
        </div>
    </footer>

    <script>
        // Piilota kirjautumisilmoitus muutaman sekunnin kuluttua
        setTimeout(function() {
            var notification = document.getElementById('login-notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000);

        // Piilota uloskirjautumisilmoitus muutaman sekunnin kuluttua
        setTimeout(function() {
            var notification = document.getElementById('logout-notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>
