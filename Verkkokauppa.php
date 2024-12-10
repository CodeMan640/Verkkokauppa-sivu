
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Tuottajamarket</title>
</head>
<body>
<?php 
require_once 'navigation.php';
require 'session_start.php';
require 'tuotehaku.php'; // Oletetaan, että tämä sisältää tietokantayhteyden ($conn)
?>

<!-- Search Form -->
<div class="search-bar">
    <form method="get" action="">
        <input type="text" name="search" placeholder="Hae tuotteita..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <button type="submit">Hae</button>
    </form>
</div>

<div class="product-list">
    <?php
    // Hae hakusana URL-parametreista
    $searchTerm = $_GET['search'] ?? '';

    // Suorita SQL-kysely käyttäen hakusanaa, jos se on annettu
    if (!empty($searchTerm)) {
        $sql = "SELECT * FROM tuotteet WHERE Nimi LIKE ? OR Kuvaus LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $searchTerm . "%";
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // Jos hakusanaa ei ole annettu, näytetään kaikki tuotteet
        $sql = "SELECT * FROM tuotteet";
        $result = $conn->query($sql);
    }

    // Tarkista, löytyykö tuotteita ja näytä ne
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='tuote'>";
            echo "<h2>" . htmlspecialchars($row["Nimi"]) . "</h2>";
            echo "<p>" . htmlspecialchars($row["Kuvaus"]) .  "</p>";
            echo "<p>Hinta: " . htmlspecialchars($row["Hinta"]) . "€</p>";
            echo "<img src='assets/" . htmlspecialchars($row["kuva"]) . "' alt='Tuotekuva'>";
            echo "<form class='add-to-cart-form' method='post'>";
            echo "<input type='hidden' name='tuote_id' value='" . htmlspecialchars($row["id"]) . "'>";
            echo "<button type='submit'>Lisää ostoskoriin</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "Ei tuotteita löytynyt.";
    }
    
    // Sulje tietokantayhteys
    $conn->close();
    ?>
</div>

<div id="notification" style="display:none; position:fixed; top:10px; right:10px; background-color:green; color:white; padding:10px; border-radius:5px;">
    Tuote lisätty ostoskoriin!
</div>

<footer>
    <div class="footer-content">
        <p>© 2024 Tuottajamarket. All rights reserved.</p>
        <p>Jesse Lipponen</p>
        <p>Savon ammattiopisto</p>
    </div>
</footer>

<script>
    // Käsitellään lomakkeen lähetys AJAX:illa, jotta sivu ei päivity turhaan
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Estetään lomakkeen oletustoiminto (sivun uudelleenlataus)
            const formData = new FormData(this); // Luodaan FormData-objekti lomaketiedoista

            fetch('ostoskori.php', {
                method: 'POST',
                body: formData // Lähetetään lomaketiedot AJAX-pyynnössä
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Tulostetaan vastaus konsoliin mahdollisten virheiden varalta
                document.getElementById('notification').style.display = 'block'; // Näytetään ilmoitus
                setTimeout(() => {
                    document.getElementById('notification').style.display = 'none'; // Piilotetaan ilmoitus 3 sekunnin kuluttua
                }, 3000);
            })
            .catch(error => console.error('Error:', error)); // Tulostetaan virhe, jos AJAX-pyyntö epäonnistuu
        });
    });
</script>
</body>
</html>
