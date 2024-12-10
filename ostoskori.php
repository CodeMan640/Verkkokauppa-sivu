<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<body> <footer>
    <div class="footer-content">
        <p>© 2024 Tuottajamarket. All rights reserved.</p>
        <p>Jesse Lipponen</p>
        <p>Savon ammattiopisto</p>
    </div>
</footer>
</body>
</html>

<?php 
require 'session_start.php';
require_once 'navigation.php';
require 'tuotehaku.php'; // Oletetaan, että tämä sisältää tietokantayhteyden ($conn)

// Varmista, että ostoskori on alustettu
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lisää, vähennä tai poista tuote ostoskorista tai tyhjennä ostoskori ostamisen yhteydessä
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? 'add';

    if ($action == 'purchase') {
        // Tyhjennä ostoskori ostamisen yhteydessä
        $_SESSION['cart'] = [];
        echo "Purchase successful!";
        exit();
    }

    $tuote_id = $_POST['tuote_id'];

    // Hae tuotetiedot tietokannasta
    $sql = "SELECT * FROM tuotteet WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tuote_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($action == 'add') {
        if (isset($_SESSION['cart'][$tuote_id])) {
            $_SESSION['cart'][$tuote_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$tuote_id] = ['product' => $product, 'quantity' => 1];
        }
    } elseif ($action == 'subtract') {
        if (isset($_SESSION['cart'][$tuote_id])) {
            $_SESSION['cart'][$tuote_id]['quantity'] -= 1;
            if ($_SESSION['cart'][$tuote_id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$tuote_id]);
            }
        }
    } elseif ($action == 'remove') {
        unset($_SESSION['cart'][$tuote_id]);
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Näytä ostoskorin sisältö
echo "<div class='cart'>";
echo "<h2>Ostoskorisi</h2>";
if (!empty($_SESSION['cart'])) {
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $product = $item['product'];
        $quantity = $item['quantity'];
        $price = $product['Hinta'] * $quantity;

        echo "<div class='cart-item'>";
        echo "<h3>" . htmlspecialchars($product['Nimi']) . "</h3>";
        echo "<p>Määrä: $quantity</p>";
        echo "<p>Yhteishinta: $price €</p>";
        echo "<button class='add' data-id='" . $product['id'] . "'>Lisää</button>";
        echo "<button class='subtract' data-id='" . $product['id'] . "'>Vähennä</button>";
        echo "<button class='remove' data-id='" . $product['id'] . "'>Poista</button>";
        echo "</div>";

        $totalPrice += $price;
    }
    echo "<h3>Kokonaishinta: $totalPrice €</h3>";
    echo "<button id='purchase' class='purchase-button'>Osta</button>";
} else {
    echo "<p>Ostoskorisi on tyhjä.</p>";
}
echo "</div>";
?>


<script>
// Käsittele tuotteiden lisääminen, vähentäminen ja poistaminen
document.querySelectorAll('.add').forEach(button => {
    button.addEventListener('click', function() {
        updateCart('add', this.dataset.id);
    });
});

document.querySelectorAll('.subtract').forEach(button => {
    button.addEventListener('click', function() {
        updateCart('subtract', this.dataset.id);
    });
});

document.querySelectorAll('.remove').forEach(button => {
    button.addEventListener('click', function() {
        updateCart('remove', this.dataset.id);
    });
});

document.getElementById('purchase').addEventListener('click', function() {
    // Lähettää pyynnön ostoksen suorittamiseksi
    const formData = new FormData();
    formData.append('action', 'purchase');

    fetch('ostoskori.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert("Osto suoritettu onnistuneesti!");
        // Tyhjennä ostoskori
        document.querySelector('.cart').innerHTML = "<p>Ostoskorisi on tyhjä.</p>";
    })
    .catch(error => console.error('Virhe:', error));
});



// Funktio ostoskorin päivittämiseen AJAX:illa
function updateCart(action, tuote_id) {
    const formData = new FormData();
    formData.append('action', action);
    formData.append('tuote_id', tuote_id);

    fetch('ostoskori.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Virhe:', error));
}
</script>  
